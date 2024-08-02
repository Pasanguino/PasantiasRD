<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'description',
        'age',
        'photo_path',
        'identification_path',
        'cv_path',
        'profession_id',
        'type_user_id',
        'province_id',
    ];

    
public function profession(){
    return $this->hasOne(Profession::class);
}
public function users(){
    return $this->belongsTo(User::class);
}
}

