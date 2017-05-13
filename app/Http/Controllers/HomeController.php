<?php

namespace Chatty\Http\Controllers;

use Chatty\Models\Status;
use Illuminate\Http\Request;

use Chatty\Http\Requests;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::check()){
            $statuses = Status::noReply()->where(function($query){
                $query->where('user_id', Auth::user()->id)
                      ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            return view('timeline.index', compact('statuses'));
        }
        return view('home');
    }
}
