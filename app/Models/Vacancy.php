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
        'province_id',
        'area_id',
        'position_id'
    ];

    public function application(){
        return $this->hasMany(Application::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function areas()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function positions()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'vacancy_id');
    }

    public function provinces()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
