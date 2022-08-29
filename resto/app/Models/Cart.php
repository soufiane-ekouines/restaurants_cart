<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'user_id',
        'tanks',
        'name_wifi',
        'password_wifi',
    ];
}
