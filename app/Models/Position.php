<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'position_name', // String
    ];

    public function areas(){
        return $this->belongsTo(Area::class);
    }
}
