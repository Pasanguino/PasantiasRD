<?php

// app/Events/MessageSent.php

namespace App\Events;

use App\Models\Mensaje;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mensaje;

    public function __construct(Mensaje $mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function broadcastOn()
    {
        return new Channel('chat-' . $this->mensaje->chat_id);
    }

    public function broadcastAs()
    {
        return 'message-sent';
    }
}
