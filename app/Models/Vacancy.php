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
        'company_id',
        'user_id',
        'pronvice_id',
        'area_id',
        'position_id'
    ];

    public function application(){
        return $this->hasMany(Application::class);
    }
    public function users(){
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

    public function provinces(){
        return $this->belongsTo(Province::class);
    }
}
