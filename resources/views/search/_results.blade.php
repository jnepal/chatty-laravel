@extends('layout')

@section('content')
    <h3>Search Results: "{{ request()->input('query') }}"</h3>

    <div class="row">
        <div class="col-lg-12">
            @if(!$users->count())
                <p>No Results Found</p>
            @else
                @foreach($users as $user)
                    @include('users.partials._userblock')
                @endforeach
            @endif

        </div>
    </div>
@stop