<div class="form-group {{$errors->has('email')? 'has-error': ''}}">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    <span class="help-block">
        @if($errors->has('email'))
            {{ $errors->first('email') }}
        @endif
    </span>
</div>
<div class="form-group {{ $errors->has('password')? 'has-error': '' }}">
    {!! Form::label('password', 'Password') !!}
    {!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
    <span class="help-block">
        @if($errors->has('password'))
            {{  $errors->first('password') }}
        @endif
    </span>
</div>
<div class="form-group">
    <label>
        {!! Form::checkbox('remember', null, true) !!} Remember me
    </label>
</div>
<div class="form-group">
    {!! Form::submit('Login', ['class' => 'btn btn-default']) !!}
</div>