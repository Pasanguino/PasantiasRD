<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'area_name', // String
        'first_name',
        'last_name',
        'age',
        'photo_path',
        'identification_path',
        'cv_path',
        'description',
        'ability',
        'experience',
        'year_month',
        'area_id',
        'position_id',
        'aplicaction_id'
    ];
}
