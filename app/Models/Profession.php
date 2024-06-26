<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'profession_name', // String
    ];

    public function use_profile(){
        return $this->hasMany(UserProfile::class); 
    }
}
