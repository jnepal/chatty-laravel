@extends('layout')

@section('content')
    <h3>Create a New Account</h3>
    <div class="row">
        <div class="col-lg-6">
            {!! Form::open() !!}
                @include('auth._signupform')
            {!! Form::close() !!}
        </div>
    </div>

@stop