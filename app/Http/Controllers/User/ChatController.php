<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Tampilkan daftar percakapan User.
     */
    public function index()
    {
        $userId = auth()->id();
        $conversations = Conversation::where('user_id', $userId)
            ->with(['manager', 'vehicle', 'latestMessage'])
            ->orderByRaw('COALESCE(last_message_at, updated_at) DESC')
            ->paginate(15);

        return view('user.chat.index', compact('conversations'));
    }

    /**
     * Mulai atau buka percakapan dengan Manager Armada tertentu.
     */
    public function start(Request $request)
    {
        $userId = auth()->id();
        $vehicleId = $request->query('vehicle_id');
        $managerId = $request->query('manager_id');
        $vehicle = null;

        if ($vehicleId) {
            $vehicle = Vehicle::with('manager')->find($vehicleId);
            if ($vehicle) {
                $managerId = $vehicle->manager_id;
                // Jika armada belum terhubung ke manager_id tertentu, arahkan ke manager lokasi tersebut
                if (!$managerId && $vehicle->location) {
                    $manager = User::where('role', 'manager')
                        ->where('location', $vehicle->location)
                        ->first();
                    $managerId = $manager?->id;
                }
            }
        }

        // Jika manager belum didapatkan, cari manager manapun
        if (!$managerId) {
            $manager = User::where('role', 'manager')->first();
            $managerId = $manager?->id;
        }

        if (!$managerId) {
            return back()->with('error', 'Saat ini belum ada manager armada yang tersedia untuk dihubungi.');
        }

        // Cari atau buat percakapan per akun User & Manager
        $conversation = Conversation::firstOrCreate(
            [
                'user_id' => $userId,
                'manager_id' => $managerId,
            ],
            [
                'vehicle_id' => $vehicle?->id,
                'last_message_at' => now(),
            ]
        );

        // Jika armada baru dikirim dan percakapan sudah ada, perbarui referensi vehicle_id terkini
        if ($vehicle && $conversation->vehicle_id !== $vehicle->id) {
            $conversation->update(['vehicle_id' => $vehicle->id]);
        }

        return redirect()->route('user.chat.show', $conversation->id);
    }

    /**
     * Buka ruang obrolan tertentu.
     */
    public function show($id)
    {
        $userId = auth()->id();
        $conversation = Conversation::where('id', $id)
            ->where('user_id', $userId)
            ->with(['manager', 'vehicle', 'messages.sender'])
            ->firstOrFail();

        // Tandai pesan dari manager sebagai sudah dibaca
        Message::where('conversation_id', $conversation->id)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Hitung kuota pesan berturut-turut user (maksimal 3x sebelum dibalas manager)
        $consecutiveUserMsgs = $this->getConsecutiveUserMessagesCount($conversation->id, $userId);
        $remainingQuota = max(0, 3 - $consecutiveUserMsgs);

        // Daftar percakapan untuk sidebar
        $conversations = Conversation::where('user_id', $userId)
            ->with(['manager', 'vehicle', 'latestMessage'])
            ->orderByRaw('COALESCE(last_message_at, updated_at) DESC')
            ->get();

        return view('user.chat.show', compact('conversation', 'conversations', 'remainingQuota', 'consecutiveUserMsgs'));
    }

    /**
     * Hitung berapa pesan user dikirim berturut-turut sejak pesan terakhir dari manager.
     */
    protected function getConsecutiveUserMessagesCount($conversationId, $userId): int
    {
        $lastManagerMsg = Message::where('conversation_id', $conversationId)
            ->where('sender_id', '!=', $userId)
            ->latest()
            ->first();

        $query = Message::where('conversation_id', $conversationId)
            ->where('sender_id', $userId);

        if ($lastManagerMsg) {
            $query->where('created_at', '>', $lastManagerMsg->created_at);
        }

        return $query->count();
    }

    /**
     * Kirim pesan baru.
     */
    public function send(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $userId = auth()->id();
        $conversation = Conversation::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // VALIDASI KUOTA 3X CHAT SEBELUM DIBALAS MANAGER
        $consecutive = $this->getConsecutiveUserMessagesCount($conversation->id, $userId);
        if ($consecutive >= 3) {
            $err = 'Batas chat tercapai (3/3 pesan). Mohon tunggu balasan dari Manager sebelum mengirim pesan lagi.';
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $err,
                    'remaining_quota' => 0,
                ], 422);
            }
            return back()->with('error', $err);
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $userId,
            'receiver_id' => $conversation->manager_id,
            'message' => trim($request->message),
            'is_read' => false,
        ]);

        $conversation->update([
            'last_message_at' => now(),
        ]);

        $newConsecutive = $consecutive + 1;
        $remainingQuota = max(0, 3 - $newConsecutive);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'remaining_quota' => $remainingQuota,
                'message' => [
                    'id' => $message->id,
                    'message' => $message->message,
                    'is_me' => true,
                    'sender_name' => auth()->user()->name,
                    'created_at' => $message->created_at->format('H:i'),
                ],
            ]);
        }

        return redirect()->route('user.chat.show', $conversation->id);
    }

    /**
     * Endpoint polling pesan untuk update realtime via AJAX.
     */
    public function messages(Request $request, $id)
    {
        $userId = auth()->id();
        $conversation = Conversation::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Tandai pesan baru dari lawan sebagai dibaca
        Message::where('conversation_id', $conversation->id)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = $conversation->messages()
            ->with('sender')
            ->get()
            ->map(function ($msg) use ($userId) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'is_me' => $msg->sender_id === $userId,
                    'sender_name' => $msg->sender->name ?? 'User',
                    'created_at' => $msg->created_at->format('H:i'),
                    'date' => $msg->created_at->format('d M Y'),
                ];
            });

        $consecutive = $this->getConsecutiveUserMessagesCount($conversation->id, $userId);
        $remainingQuota = max(0, 3 - $consecutive);

        return response()->json([
            'success' => true,
            'remaining_quota' => $remainingQuota,
            'messages' => $messages,
        ]);
    }
}
