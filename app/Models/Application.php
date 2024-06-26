<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id', // String
        'vacancy_id',
    ];

    public function vacancies(){
        return $this->hasOne(Vacancy::class); 
    }
    
    public function application_details(){
        return $this->hasOne(Application_detail::class); 
    }

    public function users(){
        return $this->belongsTo(User::class); 
    }
}
