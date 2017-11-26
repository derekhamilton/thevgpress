@extends ('main')
@section ('title') GG Weekly News @endsection
@section ('heading') GG Weekly News @endsection

@section ('content')
    @foreach ($news as $item)
    @endforeach

    @include ('comments', array('comments' => $comments))
@endsection
