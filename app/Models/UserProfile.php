<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    
public function profession(){
    return $this->hasOne(Profession::class);
}
public function users(){
    return $this->belongsTo(User::class);
}
}

function gradingStudents($grades) {
    foreach($grades as &$grade){
        if($grade >= 38){
            $c = (ceil($grade / 5)* 5);
            if( $c - $grade < 3 ){
                $grade = $c;
            }
        }
    }
    return $grades;
}