<?php

namespace Chatty\Http\Controllers;

use Illuminate\Http\Request;
use Chatty\Http\Requests;
use Chatty\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Returns the signup form
     *
     */
    public function create(){
        return view('auth.signup');
    }

    /**
     * Stores the Users in Database
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request){
        /**
         * Form Validation
         */
        $this->validate($request, [
            'email'    => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash',
            'password' => 'required'
        ]);

        /**
         * Inserting the User Info into Database
         */

        User::create($request->all());

        /**
         * Flash message
         */
        Session::flash('flash_message', 'Your Account has been created');

        return redirect('/');
    }

    /**
     *Returns the Login form
     */
    public function getLogin(){
        return view('auth.signin');
    }

    /*
     * Handles the post Request of the login credentials
     */
    public function postLogin(Request $request){

        /**
         * Form Validation
         */

        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))){
            Session::flash('flash_message', 'Incorrect Email or Password');
            Session::flash('flash_message_important', true);
            Session::flash('flash_message_error', true);
            return redirect('/user/signin');
        }

        return redirect('/');

    }

    /**
     * User Logout
     * @return void
     */
    public function logout(){
        Auth::logout();
        
        return redirect('/');
    }

}
