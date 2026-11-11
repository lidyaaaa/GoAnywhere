<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Tampilkan daftar percakapan Manager dengan para Customer/User.
     */
    public function index()
    {
        $managerId = auth()->id();
        $conversations = Conversation::where('manager_id', $managerId)
            ->with(['user', 'vehicle', 'latestMessage'])
            ->orderByRaw('COALESCE(last_message_at, updated_at) DESC')
            ->paginate(15);

        return view('manager.chat.index', compact('conversations'));
    }

    /**
     * Manager memulai chat langsung dengan Penyewa (User) tertentu.
     */
    public function start(Request $request)
    {
        $managerId = auth()->id();
        $userId = $request->query('user_id');
        $vehicleId = $request->query('vehicle_id');

        if (!$userId) {
            return back()->with('error', 'User/Penyewa tidak ditemukan.');
        }

        $user = User::findOrFail($userId);
        $vehicle = $vehicleId ? Vehicle::find($vehicleId) : null;

        // Cari atau buat percakapan antara manager ini dan user tersebut
        $conversation = Conversation::firstOrCreate(
            [
                'user_id' => $user->id,
                'manager_id' => $managerId,
                'vehicle_id' => $vehicle?->id,
            ],
            [
                'last_message_at' => now(),
            ]
        );

        return redirect()->route('manager.chat.show', $conversation->id);
    }

    /**
     * Buka ruang obrolan dengan User tertentu.
     */
    public function show($id)
    {
        $managerId = auth()->id();
        $conversation = Conversation::where('id', $id)
            ->where('manager_id', $managerId)
            ->with(['user', 'vehicle', 'messages.sender'])
            ->firstOrFail();

        // Tandai pesan dari user sebagai sudah dibaca oleh manager
        Message::where('conversation_id', $conversation->id)
            ->where('receiver_id', $managerId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Daftar percakapan untuk sidebar
        $conversations = Conversation::where('manager_id', $managerId)
            ->with(['user', 'vehicle', 'latestMessage'])
            ->orderByRaw('COALESCE(last_message_at, updated_at) DESC')
            ->get();

        return view('manager.chat.show', compact('conversation', 'conversations'));
    }

    /**
     * Balas pesan User.
     */
    public function send(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $managerId = auth()->id();
        $conversation = Conversation::where('id', $id)
            ->where('manager_id', $managerId)
            ->firstOrFail();

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $managerId,
            'receiver_id' => $conversation->user_id,
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

        return redirect()->route('manager.chat.show', $conversation->id);
    }

    /**
     * Endpoint polling pesan untuk update realtime via AJAX.
     */
    public function messages(Request $request, $id)
    {
        $managerId = auth()->id();
        $conversation = Conversation::where('id', $id)
            ->where('manager_id', $managerId)
            ->firstOrFail();

        // Tandai pesan dari user sebagai dibaca
        Message::where('conversation_id', $conversation->id)
            ->where('receiver_id', $managerId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = $conversation->messages()
            ->with('sender')
            ->get()
            ->map(function ($msg) use ($managerId) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'is_me' => $msg->sender_id === $managerId,
                    'sender_name' => $msg->sender->name ?? 'Manager',
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
