<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function roleText()
    {
        if($this->role){
            return 'Admin';

        }else if($this->role){
            return 'Private';

        }else if($this->role){
            return 'Public';

        }else {
            return 'Default';
        }
    }
    public function verifyDisplay()
    {
        if($this->status_verified == 1){
            return '<span class="badge badge-success">Verified</span>';
        }else{
            return '<span class="badge badge-light">Unverified</span>';
        }
    }
}
