<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    //fillable name, type, start_date, end_date, year
    protected $fillable = ['name', 'type', 'start_date', 'end_date', 'year'];
}
