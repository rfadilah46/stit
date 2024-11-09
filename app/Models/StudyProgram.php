<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;
    //fillable
    protected $fillable = [
        'name',
        'description',
        'faculty_id',
        'head_of_study_program',
        'study_program_code',
        'study_program_level',
        'study_program_type',
        'study_program_duration'
    ];
}
