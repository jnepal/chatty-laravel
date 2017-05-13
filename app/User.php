<?php

namespace Chatty;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Hashes the Password
     * @param $password
     */
    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Converts the username Attribute to lower case
     * @param $username
     */
    public function setUsernameAttribute($username){
        $this->attributes['username'] = strtolower($username);
    }
    /**
     * Converts the first letter of the first_name attribute to Uppercase
     * @param $lastname
     */
    public function setFirstnameAttribute($firstname){
        $this->attributes['first_name'] = ucfirst($firstname);
    }

    /**
     * Converts the first letter of the last_name attribute to Uppercase
     * @param $lastname
     */
    public function setLastnameAttribute($lastname){
        $this->attributes['last_name'] = ucfirst($lastname);
    }

}
