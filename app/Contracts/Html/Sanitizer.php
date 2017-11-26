<?php
namespace App\Contracts\Html;

interface Sanitizer
{
    /**
     * @param string $string
     * @return string
     */
    public function sanitize($string);
}
