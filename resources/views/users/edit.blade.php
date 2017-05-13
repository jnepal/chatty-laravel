@extends('layout')
@section('content')
    <h3>Update your profile</h3>
    <div class="row">
        <div class="col-lg-6">
            {!! Form::open() !!}
                @include('users.partials._form')
            {!! Form::close() !!}
        </div>
    </div>
@stop