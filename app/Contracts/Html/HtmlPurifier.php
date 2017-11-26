<?php
namespace App\Contracts\Html;

interface HtmlPurifier
{
    /**
     * @param string $html
     * @return string
     */
    public function purify($html);
}
