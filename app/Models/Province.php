<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'province_name', // String
    ];

    public function users(){
        return $this->hasMany(User::class); 
    }

    public function vacancies(){
        return $this->hasMany(Vacancy::class); 
    }

    public function companies(){
        return $this->hasMany(Company::class); 
    }
}
