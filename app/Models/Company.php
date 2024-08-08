<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name', // No es necesario incluir 'id' en fillable, ya que se autoincrementa automáticamente
        'province_id',  // Agregar province_id si deseas permitir la asignación masiva
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}