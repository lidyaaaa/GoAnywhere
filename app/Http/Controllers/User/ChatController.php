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

        // Cari atau buat percakapan
        $conversation = Conversation::firstOrCreate(
            [
                'user_id' => $userId,
                'manager_id' => $managerId,
                'vehicle_id' => $vehicle?->id,
            ],
            [
                'last_message_at' => now(),
            ]
        );

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

        // Daftar percakapan untuk sidebar
        $conversations = Conversation::where('user_id', $userId)
            ->with(['manager', 'vehicle', 'latestMessage'])
            ->orderByRaw('COALESCE(last_message_at, updated_at) DESC')
            ->get();

        return view('user.chat.show', compact('conversation', 'conversations'));
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

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
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

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }
}
