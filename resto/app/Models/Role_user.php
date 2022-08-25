<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'role_id'
    ];

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }
    public function User()
    {
        return $this->hasOne(User::class);
    }
}
