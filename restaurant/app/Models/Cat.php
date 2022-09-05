<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;
    protected $fillable = ['designation','user_id'];

    public function Products()
    {
        return $this->hasMany(Product::class);
    }

}
