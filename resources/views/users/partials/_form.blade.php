<div class="row">
    <div class="col-lg-6">
        <div class="form-group {{ $errors->has('first_name')? 'has-error': '' }}">
            {!! Form::label('first_name', 'First Name') !!}
            {!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}
            @if($errors->has('first_name'))
                <span class="help-block">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group {{ $errors->has('last_name')? 'has-error': '' }}">
            {!! Form::label('last_name', 'Last Name') !!}
            {!! Form::text('last_name', $user->last_name, ['class' => 'form-control']) !!}
            @if($errors->has('last_name'))
                <span class="help-block">{{ $errors->first('last_name') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="form-group"{{ $errors->has('location')? 'has-error': '' }}>
    {!! Form::label('location', 'Location') !!}
    {!! Form::text('location', $user->location, ['class' => 'form-control']) !!}
    @if($errors->has('location'))
        <span class="help-block">{{ $errors->first('location') }}</span>
    @endif
</div>
<div class="form-group">
    {!! Form::submit('Update', ['class' => 'btn btn-default']) !!}
</div>
