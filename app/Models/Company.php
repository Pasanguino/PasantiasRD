<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'company_name', // String
    ];

    public function users(){
        return $this->hasMany(User::class); 
    }

    public function vacancies(){
        return $this->hasMany(Vacancy::class); 
    }
}
