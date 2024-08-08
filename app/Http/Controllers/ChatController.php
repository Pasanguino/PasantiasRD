<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function show($id)
    {
        $chat = Chat::with(['user1', 'user2', 'mensajes.user'])->findOrFail($id);

        // Verificar si el usuario autenticado es parte del chat
        if (Auth::id() !== $chat->user1_id && Auth::id() !== $chat->user2_id) {
            return redirect()->route('dashboard')->withErrors('No tienes acceso a este chat.');
        }

        return Inertia::render('Chat/Show', [
            'chat' => $chat,
            'userId' => Auth::id(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user2_id' => 'required|exists:users,id',
        ]);

        $chat = Chat::create([
            'user1_id' => Auth::id(),
            'user2_id' => $request->input('user2_id'),
        ]);

        return response()->json($chat, 201);
    }

    public function index()
    {
        $chats = Chat::where('user1_id', Auth::id())
            ->orWhere('user2_id', Auth::id())
            ->get();

        return response()->json($chats);
    }
}
