<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    //fillable
    protected $fillable = [
        'name',
        'description',
        'sks',
        'study_program_id',
        'professor_id',
        'assistant_professor',
        'semester',
        'faculty_id'
    ];
}
