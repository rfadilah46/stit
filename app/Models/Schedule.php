<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    //fillable
    protected $fillable = [
        'name',
        'description',
        'day',
        'start_time',
        'end_time'
    ];
}
