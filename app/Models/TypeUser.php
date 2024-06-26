<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'type_user', // String
    ];


    public function users(){
        return $this->hasMany(User::class); 
    }
}
