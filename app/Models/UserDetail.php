<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    //fillable
    protected $fillable = [
        'user_id',
        'nim',
        'gender',
        'address',
        'phone',
        'photo',
        'birthdate',
        'city_birth',
        'father_name',
        'mother_name',
        'last_education',
        'admitted_at',
        'study_program_id',
        'faculty_id',
        'blood_type',
        'nationality',
        'religion'
    ];
}
