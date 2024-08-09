<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Broadcast;

class MensajeController extends Controller
{

    public function store(Request $request, $chatId)
    {
        $request->validate([
            'mensaje' => 'required|string',
        ]);

        $mensaje = Mensaje::create([
            'chat_id' => $chatId,
            'user_id' => auth()->id(),
            'mensaje' => $request->input('mensaje'),
        ]);

        // Broadcast(new MessageSent($mensaje))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }




    public function index($chatId)
    {
        $mensajes = Mensaje::where('chat_id', $chatId)
            ->with('user') // Asegúrate de incluir el usuario que envió el mensaje
            ->get();

        return response()->json($mensajes);
    }
}
