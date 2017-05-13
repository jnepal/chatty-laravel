<nav class="navbar navbar-default" role="navigation">
    <div class = "container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">Chatty</a>
        </div>
        <div class="collapse navbar-collapse">
            {{--@if(Auth::check())--}}
                <ul class="nav navbar-nav">
                    <li><a href="#">Timeline</a> </li>
                    <li><a href="{{ url('user/friend') }}">Friends</a> </li>
                </ul>
                <form class="navbar-form navbar-left" role="search" action="{{ url('/user/search') }}">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control" placeholder="Find People">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            {{--@endif--}}
            <ul class="nav navbar-nav navbar-right">
                {{--@if(Auth::auth())--}}
                    {{--<li><a href="{{ action('ProfileController@index', ['username' => Auth::user()->username ]) }}">{{ Auth::user()->getFirstNameOrUsername() }}</a></li>--}}
                    {{--<li><a href="{{ action('ProfileController@edit', ['id' => Auth::user()->id]) }}">Update Profile </a></li>--}}
                    <li><a href="{{ url('user/signout') }}">Signout</a></li>
                {{--@endif--}}
                <li><a href="{{ url('/user/signup') }}">Sign up</a></li>
                <li><a href="{{ url('/user/signin') }}">Sign in</a></li>
            </ul>
        </div>
    </div>
</nav>