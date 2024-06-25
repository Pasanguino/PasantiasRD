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
}
