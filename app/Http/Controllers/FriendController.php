<?php

namespace Chatty\Http\Controllers;

use Chatty\Models\User;
use Illuminate\Http\Request;

use Chatty\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FriendController extends Controller
{
    public function index(){

        $friends  = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('friends.index', compact('friends', 'requests'));
    }

    public function add($username){
        $user = User::where('username', $username)->first();

        if(!$user){
            Session::flash('flash_message', "User not found");
            return redirect('/');
        }
        if(Auth::user()->id === $user->id){
            return redirect('/');
        }

        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
            Session::flash('flash_message', 'Friend request pending');
            Session::flash('flash_message_important', true);

            return redirect()->action('ProfileController@index', ['username' => $user->username]);
        }

        if(Auth::user()->isFriendsWith($user)){
            Session::flash('flash_message', 'You are already friend');

            return redirect()->action('ProfileController@index', ['username' => $user->username]);
        }

        Auth::user()->addFriend($user);
        Session::flash('flash_message', 'Friend Request Sent');

        return redirect()->action('ProfileController@index', ['username' => $user->username]);
    }

    public function accept($username){
        $user = User::where('username', $username)->first();

        if(!$user){
            Session::flash('flash_message', 'User not found');
            return redirect('/');
        }

        if(!Auth::user()->hasFriendRequestReceived($user)){
            return redirect('/');
        }

        Auth::user()->acceptFriendRequest($user);

        Session::flash('flash_message', 'Friend Request accepted');

        return redirect('/user/friend');
    }

    public function unfriend($username){
        $user = User::where('username', $username)->first();
        if(!$user){
            return redirect('/');
        }
        if(!Auth::user()->isFriendsWith($user)){
            return redirect()->back();
        }

        Auth::user()->deleteFriend($user);

        Session::flash('flash_message', 'Unfriended ');

        return redirect()->back();
    }
}
