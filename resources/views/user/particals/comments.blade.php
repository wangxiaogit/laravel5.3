<ul class="list-group">
    @forelse($user->comments as $comment)
        <li class="list-group-item">
            @if($comment->commentable)

                @if($comment->commentable_type == 'articles')
                    <a href="{{ url($comment->commentable->slug) }}">{{ $comment->commentable->title }}</a>
                @else
                    <a href="{{ url('discussion', ['id' => $comment->commentable_id]) }}">{{ $comment->commentable->title }}</a>
                @endif

                <span class="meta">
                    in <span class="timeago">{{ $comment->created_at->diffForHumans() }}</span>
                </span>

                {{--<parse :content="{{ $comment->content }}"></parse>--}}
            @else
                {{ lang('Forbidden') }}
            @endif
        </li>
    @empty
        <li class="nothing">{{ lang('Nothing') }}</li>
    @endforelse
</ul>