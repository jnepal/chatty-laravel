@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            {{ Form::open(['action' => 'StatusController@store']) }}
                <div class="form-group {{ $errors->has('body')? 'has-error' : '' }}">
                    {{ Form::textarea('body', null, ['rows' => 2 , 'placeholder' => "What's up ?", 'class' => 'form-control']) }}
                    @if($errors->has('body'))
                        <span class="help-block">{{ $errors->first('body') }}</span>
                    @endif
                </div>
            {{ Form::submit('Update Status', ['class' => 'btn btn-default pull-right']) }}
            {{ Form::close() }}


        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <hr>
            <!--- Timeline status and replies --->
            @if(!$statuses->count())
                <p>There is nothing in your timeline</p>
            @endif

            @foreach($statuses as $status)
                @include('users.status.status')

                <div class="media col-sm-offset-1">
                    <div class="media-body">
                        @foreach($status->replies as $reply)
                            @include('users.status.reply')
                        @endforeach

                        @include('users.comment._form')
                    </div>
                </div>
            @endforeach
            {!! $statuses->render() !!}
        </div>
    </div>
@stop