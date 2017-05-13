<div class="media">
    <a href="{{ action('ProfileController@index', ['username' => $reply->user->username]) }}" class="pull-left">
        <img src="{{ $reply->user->getAvatar() }}" alt="{{ $reply->user->getNameOrUsername() }}" class="media-object">
    </a>
    <div class="media-body">
        <h5 class="media-heading"><a href="{{ action('ProfileController@index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
    </div>
    <p>{{$reply->body}}</p>
    <ul class="list-inline">
        <li>{{ $reply->created_at->diffForHumans() }}</li>
        @if($reply->user->id !== Auth::user()->id)
            <li><a href="{{ action('StatusController@like', ['statusId' => $reply->id]) }}">Like</a></li>
        @endif
        <li>{{ $reply->likes->count() }} {{ str_plural('like', $reply->likes->count()) }}</li>
    </ul>
</div>