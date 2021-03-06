<div class="comment-container" id="comment-{{ $comment->id }}">
    <div class="sidebar">
        <div class="username">
            <a href="{{ URL::to('profile/'.$comment->author->username) }}">
                {{ $comment->author->username }}
            </a>
        </div>
        <div class="avatar">
            <img
                src="{{
                    URL::to('uploads/users/'.$comment->author->username)
                }}"
                alt="{{ $comment->author->username }}"
            >
        </div>
        <div class="score stat">
            <a href="{{ URL::to('leaderboard') }}">
                Rank: {{ $comment->author->rank() }}
                ({{ $comment->author->score }})
            </a>
        </div>
        <div class="country stat">
            Country:
        </div>
        <div class="comment-count stat">
            Comments: {{ $comment->author->commentCount() }}
        </div>
        <div class="news-count stat">
            News Posts: {{ $comment->author->newsCount() }}
        </div>
        <div class="joined stat">
            Joined: {{ explode(' ', $comment->author->created_at)[0] }}
        </div>
    </div>

    <div class="content-container">
        <div class="content">
            <div class="topbar">
                <div class="likes">
                    <span
                        class="comment-score"
                        id="comment-score-{{ $comment->id }}"
                    >
                        {{ $comment->likes(true) }}
                    </span>

                    @if ($loggedInUser)
                        <input
                            type="checkbox"
                            class="like"
                            data-toggle="toggle"
                            data-on="Liked!"
                            data-off="Like"
                            data-size="small"
                            value="{{ $comment->id }}"
                            @if ($comment->likedBy($loggedInUser->id))
                                checked="checked"
                            @endif
                        >
                    @endif
                </div>
                <div class="created-at">{{ $comment->created_at }}</div>
            </div>

            <div class="main">
                <div class="comment">
                    {!! sanitize($comment->comment) !!}
                </div>

                @if ($comment->updated_at != $comment->created_at)
                    <div class="updated-at">
                        Edited: {{ $comment->updated_at }}
                    </div>
                @endif

                <div class="signature">
                    {!! sanitize($comment->author->signature) !!}
                </div>
            </div>
        </div>
    </div>
</div>
