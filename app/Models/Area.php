<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'area_name' // String
    ];

    public function positions(){
        return $this->hasMany(Position::class); 
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class, 'area_id');
    }

}
