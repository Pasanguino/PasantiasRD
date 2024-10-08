<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

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
        'province_id',
        'user_id'
    ];

    

public function profession(){
    return $this->hasOne(Profession::class);
}

public function province(){
    return $this->hasOne(Province::class);
}
public function users(){
    return $this->belongsTo(User::class);
}
}

