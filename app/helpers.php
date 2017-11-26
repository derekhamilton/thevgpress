<?php

function sanitize($string)
{
    return app(App\Contracts\Html\Sanitizer::class)->sanitize($string);
}
