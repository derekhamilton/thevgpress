@extends ('main')

@section ('title', $user->username."'s Profile")

@section ('content')
    {{-- Profile --}}
    <div id="profileText">
        {!! sanitize($user->profile) !!}
    </div>

    {{-- Highlight Blog --}}
    @if ($blog)
        <div id="mostRecentBlog">
            <div class="title">{!! sanitize($blog->getTitle()) !!}</div>
            <div class="content">{!! sanitize($blog->getContent()) !!}</div>
        </div>
    @endif

    {{-- Blogs --}}

    {{-- Reviews --}}

    {{-- Comments --}}

    {{-- Stars --}}

    {{-- User Summary --}}
    <h2>{{ $user->username }}</h2>

    {{-- Menu --}}

    {{-- Friends Blogs --}}

    {{-- Friends Reviews --}}

    {{-- Friends Comments --}}
@endsection
