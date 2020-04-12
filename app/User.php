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
        if($this->role == 1){
            return 'admin';

        }else if($this->role == 2){
            return 'private';

        }else if($this->role == 3){
            return 'public';

        }else {
            return 'default';
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

    public function role()
    {
        return $this->belongsTo('App\Models\Role','role');
    }
 
    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
       
        if($this->have_role->role_name === $roles){
           return true;
        }  

        return false;
    }
    private function getUserRole()
    {
       return $this->role()->getResults();
    }
    
    private function cekUserRole($role)
    {  
        return (strtolower($role) == strtolower($this->have_role->role_name)) ? true : false;
    }
}
