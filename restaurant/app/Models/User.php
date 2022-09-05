<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'Phone',
        'Adresse',
        'desc',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne(Role_user::class);
    }

    public function messagesendNoread()
    {
        return $this->hasMany(Message::class,'userSend_id')->where('userGet_id',Auth()->id())->where('read_',false);
    }

    public function message_get()
    {
        return $this->hasMany(Message::class,'userGet_id');
    }

    public function last_get_send()
    {
        return $this->hasMany(Message::class,'userSend_id')->orderBy('created_at','DESC');
    }
    public function last_get()
    {
        return $this->hasMany(Message::class,'userGet_id')->orderBy('created_at','DESC');
    }
    public function Lastmessage()
    {
        return Message::where('userSend_id',$this->id)
                        ->Orwhere('userGet_id',$this->id)
                        ->orderBy('created_at','DESC')
                        ->first();
    }

}
