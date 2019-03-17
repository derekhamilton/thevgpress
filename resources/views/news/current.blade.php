@extends ('main')
@section ('title', 'GG Weekly News')
@section ('heading', 'GG Weekly News')

@section ('styles')
    {!! Html::style('css/bootstrap-toggle.min.css') !!}
    {!! Html::style('css/news.css') !!}
    {!! Html::style('css/forum-topic.css') !!}
    {!! Html::style('css/bootstrap-wysihtml5.css') !!}
@endsection

@section ('scripts')
    {!! Html::script('js/bootstrap-toggle.min.js') !!}
    {!! Html::script('js/wysihtml5.min.js') !!}
    {!! Html::script('js/bootstrap3-wysihtml5.js') !!}
    {!! Html::script('js/wysihtml5-bgColor.js') !!}
    {!! Html::script('js/newsClick.js') !!}
    {!! Html::script('js/news.js') !!}
    {!! Html::script('js/comment.js') !!}
@endsection

@section ('content')
    <div id="gg-weekly-news-container">
        @include ('news.days', ['days' => $days])
    </div>

    @include ('news.form')

    @include ('comments', ['comments' => $comments])
@endsection
