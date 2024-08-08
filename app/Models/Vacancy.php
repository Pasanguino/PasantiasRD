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

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id'); // Reemplaza 'area_id' si el nombre del campo es diferente
    }
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id'); // Reemplaza 'position_id' si el nombre del campo es diferente
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'vacancy_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id'); // Reemplaza 'province_id' si el nombre del campo es diferente
    }
}
