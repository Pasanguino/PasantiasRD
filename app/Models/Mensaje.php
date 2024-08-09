<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'user_id',
        'mensaje',
    ];

    /**
     * Obtiene el chat al que pertenece el mensaje.
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Obtiene el usuario que envió el mensaje.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
