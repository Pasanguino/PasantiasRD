<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id', // String
        'vacancy_id',
    ];
    
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function vacancies(){
        return $this->belongsTo(Vacancy::class);
    }
    
}
