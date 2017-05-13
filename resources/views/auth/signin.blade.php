@extends('layout')

@section('content')
<div class="row">
    <h3>Sign in</h3>
    <div class="col-lg-6">
        {!! Form::open() !!}
            @include('auth._signinform')
        {!! Form::close() !!}
    </div>
</div>
@stop