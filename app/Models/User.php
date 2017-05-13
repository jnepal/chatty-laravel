<?php

namespace Chatty\Models;

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

    /**
     * Return First Name if exist
     * otherwise username
     */
    public function getFirstNameOrUsername(){
        return $this->first_name ? $this->first_name : $this->username;
    }
    /**
     * Return Full name if exists
     */
    public function getNameOrUsername(){
        $name = $this->first_name.' '.$this->last_name;

        return $name ? $name : $this->username;
    }

    public function getAvatar(){
        $hash = md5($this->email);
        return "http://www.gravatar.com/avatar/".$hash."?d=mm&s=40";
    }

    public function status(){
        return $this->hasMany('Chatty\Models\Status', 'user_id');
    }

    public function friendsOfMine(){
        return $this->belongsToMany('Chatty\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf(){
        return $this->belongsToMany('Chatty\Models\User', 'friends', 'friend_id', 'user_id');

    }

    public function friends(){
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();

    }

    public function friendRequestPending(){
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user){
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user){
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user){
        $this->friendOf()->attach($user->id);
    }

    public function deleteFriend(User $user){
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user){
       $this->friendRequests()
            ->where('id', $user->id)
            ->first()
            ->pivot
             ->update([
                'accepted' => true
            ]);
    }

    public function isFriendsWith(User $user){
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLiked(Status $status){

        return (bool) $status->likes->where('user_id', $this->id)->count();
//        return (bool) $status->likes
//                      ->where('likeable_id', $status->id)
//                      ->where('likeable_type'i, get_class($status))
//                      ->where('user_id', $this->id)
//                      ->count();
    }

    public function likes(){
        return $this->hasMany('Chatty\Models\Likeable', 'user_id');
    }
}


