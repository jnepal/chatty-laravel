{!! Form::open(array('action' => array('StatusController@reply', $status->id))) !!}
    <div class="form-group {{ $errors->has('reply-{ $status->id }') ? 'has-error' : '' }}">
        {{--{!! Form::textarea('reply-{{$status->id}}', null, ['rows' => 2, 'placeholder' => 'Reply to this status', 'class' => 'form-control']) !!}--}}
        <textarea rows="2" placeholder="Reply to this status" class="form-control" name="reply-{{ $status->id }}" cols="50"></textarea>
    @if($errors->has("reply-{{ $status->id }}"))
            <span class="help-block">{{ $errors->first('reply-{$status->id}') }}</span>
    @endif
    </div>
    {!! Form::submit('reply', ['class' => 'btn btn-default btn-sm pull-right']) !!}
{!! Form::close() !!}