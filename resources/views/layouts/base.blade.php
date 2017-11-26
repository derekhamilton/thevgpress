<!doctype html>
<html lang="en-US" dir="ltr">
    <head>
        <title>@yield('title') - The VG Press</title>

        @yield ('styles')
        @yield ('scripts')
    </head>

    <body>
        @yield ('header')

        <main id="content" class="container-fluid">
            @yield ('content')
        </main>

        @yield('footer')
    </body>
</html>
