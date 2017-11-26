<?php
namespace App\Contracts\Http\Crawlers;

interface Grabber
{
    /**
     * @param string $url Remote address to grab file from.
     * @return string
     */
    public function get($url);
}
