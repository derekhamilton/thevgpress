@extends ('layouts.base')

@section ('styles')
    {{ Html::style('css/bootstrap.min.css') }}
    {{ Html::style('css/screen.css') }}
    <link
        rel="icon"
        href="{{ URL::to('/') }}/favicon.ico"
        type="image/x-icon"
    >
    <link
        rel="shortcut icon"
        href="{{ URL::to('/') }}/favicon.ico"
        type="image/x-icon"
    >
    @yield ('styles')
@overwrite

@section ('scripts')
    {{ Html::script('js/jquery.min.js') }}
    {{ Html::script('js/bootstrap.min.js') }}
    {{ Html::script('js/moment.min.js') }}
    {{ Html::script('js/main.js') }}
    @if (isset($scripts) && is_array($scripts))
        @foreach ($scripts as $script)
            {{ Html::script($script) }}
        @endforeach
    @endif

    @if (Auth::user())
        <script async src="{{ URL::to('/') }}:3000/socket.io/socket.io.js"></script>
    @endif

    <script>
        var CSRF_TOKEN = '{!! csrf_token() !!}';
    </script>

    @yield ('scripts')
@overwrite

@section ('header')
    @include ('main-nav')
    @yield ('header')
@overwrite

@section ('content')
    <h1>@yield ('heading')</h1>

    <section id="alerts">
        @foreach (
            array(
                'errors' => 'danger',
                'warnings' => 'warning',
                'infos' => 'info',
                'successes' => 'success'
            ) as $type => $class
        )
            @include (
                'reportBagMessages',
                array(
                    'messages' => $alert->get($type),
                    'id' => $type,
                    'class' => $class
                )
            )
        @endforeach
    </section>

    @yield ('content')

    @if (!Auth::user())
        @include ('loginModal')
    @else
        <section id="chat-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <header class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Chat</h4>
                    </header>
                    <div class="modal-body">
                    </div>

                    <div id="chat-window-footer" class="modal-footer">
                    </div>
                </div>
            </div>
        </section>
    @endif
@overwrite
