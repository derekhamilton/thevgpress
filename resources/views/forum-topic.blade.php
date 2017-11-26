@extends ('main')
@section ('title') {{ $topic->title }} @endsection
@section ('heading') {{ $topic->title }} @endsection

@section ('styles')
    {!! Html::style('css/bootstrap-toggle.min.css') !!}
    {!! Html::style('css/forum-topic.css') !!}
    {!! Html::style('css/bootstrap-wysihtml5.css') !!}
@endsection

@section ('scripts')
    {!! Html::script('js/bootstrap-toggle.min.js') !!}
    {!! Html::script('js/wysihtml5.min.js') !!}
    {!! Html::script('js/bootstrap3-wysihtml5.js') !!}
    {!! Html::script('js/wysihtml5-bgColor.js') !!}
    {!! Html::script('js/comment.js') !!}
@endsection

@section ('content')
    @include ('comments', array('forumTopicId' => $topic->id, 'comments' => $comments))
@endsection
