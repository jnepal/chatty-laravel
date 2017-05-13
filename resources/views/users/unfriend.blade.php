{!! Form::open(array('action' => array('FriendController@unfriend', $user->username))) !!}
    {!! Form::submit('unfriend', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}