<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable=['designation'];

    public function RoleUser()
    {
        return $this->hasMany(Role_user::class);
    }
}
