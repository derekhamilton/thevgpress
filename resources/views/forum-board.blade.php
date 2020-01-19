@extends ('main')

@section ('title') {{ $board->title }} @endsection

@section ('styles')
    {!! Html::style('css/forum-board.css') !!}
@endsection

@section ('content')
<div>
    <a href="#" class="btn btn-large btn-default">New Topic</a>
</div>

<table class="table table-striped">

    <thead>
        <tr>
            <th class="likes">Likes</th>
            <th class="topic">Topic</th>
            <th class="replies">Replies</th>
            <th class="unread">Unread</th>
            <th class="author">Author</th>
            <th class="last-post">Last Post</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($board->topics()->paginate() as $topic)

        <tr class="@if ($topic->stickied) stickied @endif">
            <td class="likes">{{ $topic->likes(true) }}</td>
            <td class="topic">
                <div class="title">
                    <a href="{{ URL::to('forum/'.$board->slug.'/'.$topic->slug) }}">
                        {{ $topic->title }}
                    </a>
                </div>

                <div class="mod-tools">
                    Mod Tools Here
                </div>

                <div class="pages">
                    Page:
                </div>
            </td>
            <td class="replies">{{ $topic->comments()->count()-1 }}</td>
            <td class="unread">{{ $topic->unread()->count() }}</td>
            <td class="author">
                <a href="{{ URL::to('users/'.$topic->author->username) }}">
                    {{ $topic->author->username }}
                </a>
            </td>
            <td class="last-post">
                {{ $topic->lastComment()->created_at }}
                by <a href="#">{{ $topic->lastComment()->author->username }}</a>
            </td>
        </tr>

    @endforeach
    <tbody>

</table>
@endsection
