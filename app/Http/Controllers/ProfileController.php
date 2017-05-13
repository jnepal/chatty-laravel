<?php

namespace Chatty\Http\Controllers;

use Chatty\Models\User;
use Illuminate\Http\Request;

use Chatty\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Returns the profile of the user
     * @param $username
     */
    public function index($username){
        $user = User::where('username', $username)->first();

        if(!$user){
            abort(404);
        }

        $statuses         = $user->status()->noReply()->get();
        $authUserIsFriend = Auth::user()->isFriendsWith($user);

        return view('users.index', compact('user', 'statuses', 'authUserIsFriend'));
    }

    public function edit(){

        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    public function update( Request $request){

        $this->validate($request, [
            'first_name' => 'alpha|max:20',
            'last_name'  => 'alpha|max:20',
            'location'   => 'max:30',
        ]);

        $user = Auth::user();

        $user->update($request->all());

        Session::flash('flash_message', 'Your profile has been updated');

        return redirect('/');
    }
}
