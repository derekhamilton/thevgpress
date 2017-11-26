@extends ('main')
@section ('title', 'GG Weekly News')
@section ('heading', 'GG Weekly News')

@section ('styles')
    {!! Html::style('css/news.css') !!}
@endsection

@section ('content')
    <div id="gg-weekly-news-container">
        @include ('news.days', ['days' => $days])
    </div>

    @include ('news.form')

    @include ('comments', array('comments' => $comments))
@endsection
