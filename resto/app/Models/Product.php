<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'user_id',
        'cat_id',
        'prix',
        'qte',
        'enable_qte',
    ];

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }

    public function user()
    {
        return $this->BelongsTo(user::class);
    }

    public function b()
    {
        return $this->hasMany(B::class);
    }


}
