<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'importent',
        'message',
        'read',
        'userSend_id',
        'userGet_id',
    ];

    public function user()
    {
        return $this->belongsTo('user','userGet_id');
    }

    public function userSend()
    {
        return $this->belongsTo('user','userSend_id');
    }
}
