@extends ('main')

@section ('styles')
    {!! Html::style('css/login.css') !!}
@endsection

@section ('content')
    @include ('loginModal')
@endsection
