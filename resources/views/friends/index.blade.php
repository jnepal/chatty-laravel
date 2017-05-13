@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>Your Friends</h3>
            @if(!$friends->count())
                <p>You have got no friends</p>
            @else
                @foreach($friends as $user)
                    @include('users.partials._userblock')
                @endforeach
            @endif
        </div>
        <div class="col-lg-6">
            <h4>Friend Request</h4>
            <!--- List of Friend Requests --->
            @if(!$requests->count())
                <p>You have no new friend requests</p>
            @else
                @foreach($requests as $user)
                    @include('users.partials._userblock')
                @endforeach
            @endif
        </div>
    </div>
@stop