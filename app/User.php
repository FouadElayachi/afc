<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\MailResetPasswordToken;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','provider', 'provider_id', 'is_active', 'type', 'lang', 'first_name_fr', 'last_name_fr', 'first_name_ar', 'last_name_ar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Role(){
        if($this->type == 0) return 'user';
        else if($this->type == 1) return 'admin';
        else return 'admin2';
    }

    public function hasRole($role){
        return ($this->Role() === $role)?true:false;
    }
    
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
    public function form()
    {
        return $this->hasOne('App\Form');
    }
}
