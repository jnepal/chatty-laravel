@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            @include('users.partials._userblock')
            <hr>
            @if(!$statuses->count())
                <p>{{ $user->username }} has not posted anything</p>
            @else
                @foreach($statuses as $status)
                    @include('users.status.status')
                    <div class="media col-sm-offset-1">
                        <div class="media-body">
                            @foreach($status->replies as $reply)
                                @include('users.status.reply')
                            @endforeach

                            @if($authUserIsFriend || Auth::user()->id == $status->user->id)
                                @include('users.comment._form')
                            @endif
                        </div>
                    </div>

                @endforeach


            @endif
        </div>
        <div class="col-lg-4 col-lg-offset-3">
            @if(Auth::user()->hasFriendRequestPending($user))
                <p>Waiting for {{ $user->getNameOrUsername() }} to accept your request</p>
            @elseif(Auth::user()->hasFriendRequestReceived($user))
                <a href="{{ action('FriendController@accept', ['username' => $user->username] ) }}" class="btn btn-primary">Accept Friend Request</a>
            @elseif(Auth::user()->isFriendsWith($user))
                <p>You and {{ $user->getNameOrUsername() }} are friends.</p>
                @include('users.unfriend')
            @elseif(Auth::user()->id != $user->id)
                <a href="{{ action('FriendController@add', ['username' => $user->username]) }}" class="btn btn-primary">Add as Friend</a>
            @endif
            <h4>{{ $user->getFirstNameOrUsername() }}'s Friends</h4>
            @if(!$user->friends()->count())
                <p>{{ $user->getFirstNameOrUsername() }} has got no friend. Be the first</p>
            @else
                @foreach($user->friends() as $user)
                    @include('users.partials._userblock')
                @endforeach
            @endif

        </div>
    </div>
@stop