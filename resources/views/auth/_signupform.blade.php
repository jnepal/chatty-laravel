<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('first_name', 'Your First Name') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('last_name', 'Your Last Name') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-group {{$errors->has('email')? 'has-error': ''}}">
    {!! Form::label('email', 'Your Email Address') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    @if($errors->has('email'))
        <span class="help-block">{{ $errors->first('email') }}</span>
    @endif
</div>
<div class="form-group {{$errors->has('username')? 'has-error': ''}}">
    {!! Form::label('username', 'Choose a username') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
    @if($errors->has('username'))
        <span class="help-block">{{ $errors->first('username') }}</span>
    @endif
</div>
<div class="form-group {{$errors->has('password')? 'has-error': ''}}">
    {!! Form::label('password', 'Choose a password') !!}
    {!! Form::input('password','password', null, ['class' => 'form-control']) !!}
    @if($errors->has('password'))
        <span class="help-block">{{ $errors->first('password') }}</span>
    @endif
</div>

<div class="form-group">
    {!! Form::submit('Sign up', ['class' => 'btn btn-primary form-control']) !!}
</div>