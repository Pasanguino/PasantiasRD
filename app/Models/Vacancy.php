<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'vacancy_name', // String
        'vacancy_description',
        'salary',
        'company_name',
        'user_id',
        'area_id',
        'position_id'
    ];

    public function Users(){
        return $this->belongsTo(User::class);
    }

    public function areas(){
        return $this->belongsTo(Area::class);
    }

    public function positions(){
        return $this->belongsTo(Position::class);
    }

    public function favorites(){
        return $this->belongsTo(Favorite::class);
    }
}
