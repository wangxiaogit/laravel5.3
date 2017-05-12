<div class="container-fluid">
    <div class="user jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-sm-2 text-center">
                    <img src="{{ $user->avatar }}" class="avatar img-circle">
                </div>
                <div class="col-sm-5 content">
                    <div class="header">
                        {{ $user->nickname or $user->name }}
                    </div>
                    <div class="description">
                        {{ $user->description or lang('Nothing') }}
                    </div>

                    @if(Auth::check())
                        @can('update', $user)
                            <a href="{{ url('user/profile') }}" class="btn btn-info btn-sm">{{ lang('Edit Profile') }}</a>
                        @endif

                        {{--@if(Auth::id() != $user->id)--}}
                            {{--<a  href="javascript:void(0)"--}}
                                {{--class="btn btn-{{ Auth::user()->isFollowing($user->id) ? 'warning' : 'danger' }} btn-sm"--}}
                                {{--onclick="event.preventDefault();--}}
                                         {{--document.getElementById('follow-form').submit();">--}}
                                {{--{{ Auth::user()->isFollowing($user->id) ? lang('Following') : lang('Follow') }}--}}
                            {{--</a>--}}

                            {{--<form id="follow-form" action="{{ url('user/follow', [$user->id]) }}" method="POST" style="display: none;">--}}
                                {{--{{ csrf_field() }}--}}
                            {{--</form>--}}
                        {{--@endif--}}
                    @endif
                </div>
                <div class="col-sm-5 user-follow">
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="{{ url("user/{$user->name}/following") }}" class="counter">0</a>
                            <a href="{{ url("user/{$user->name}/following") }}" class="text">{{ lang('Following Num') }}</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="{{ url("user/{$user->name}/discussions") }}" class="counter">{{ $user->discussions->count() }}</a>
                            <a href="{{ url("user/{$user->name}/discussions") }}" class="text">{{ lang('Discussion Num') }}</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="{{ url("user/{$user->name}/comments") }}" class="counter">{{ $user->comments->count() }}</a>
                            <a href="{{ url("user/{$user->name}/comments") }}" class="text">{{ lang('Comment Num') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>