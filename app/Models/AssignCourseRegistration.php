<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCourseRegistration extends Model
{
    use HasFactory;
    //fillable
    protected $fillable = [
        'course_id',
        'opened_at',
        'closed_at',
        'status',
        'semester_id'
    ];
}
