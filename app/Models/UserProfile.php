<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    
public function profession(){
    return $this->hasOne(Profession::class);
}
public function users(){
    return $this->belongsTo(User::class);
}
}

