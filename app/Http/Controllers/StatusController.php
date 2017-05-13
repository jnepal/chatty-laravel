<?php

namespace Chatty\Http\Controllers;

use Chatty\Models\Status;
use Illuminate\Http\Request;

use Chatty\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StatusController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'body' => 'required|max:500'
        ]);

        Auth::user()->status()->create($request->all());

        Session::flash('flash_message', 'Your status has been posted');

        return redirect('/');
    }

    public function reply(Request $request, $statusId){

        $this->validate($request, [
            'reply-{$statusId}' => 'required|max:500'
        ],[
            'required' => 'The reply body is required'
        ]);

        $status = Status::notReply()->find($statusId);

        if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id){
            return redirect('/');
        }

        $reply = Status::create($request->all())->user()->associate(Auth::user());

        $status->replies()->save($reply);

        return redirect()->back();
    }

    public function like($statusId){
        $status = Status::findOrFail($statusId);

        if(!Auth::user()->isFriendsWith($status->user)){
            return redirect('/');
        }
        if(Auth::user()->hasLiked($status)){
            return redirect()->back();
        }

        $like =  $status->likes()->create([]);
        Auth::user()->likes()->save($like);

        return redirect('/');
    }
}
