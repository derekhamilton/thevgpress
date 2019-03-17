<?php

function sanitize(?string $string): string
{
    return app(App\Contracts\Html\Sanitizer::class)->sanitize($string);
}

function mock(string $className)
{
    return Mockery::mock($className);
}
