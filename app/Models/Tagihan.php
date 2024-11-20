<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    //fillable name, description, amount, status, user_id, payment_evidence
    protected $fillable = ['name', 'description', 'amount', 'status', 'user_id', 'payment_evidence'];
}
