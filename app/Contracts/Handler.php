<?php
namespace App\Contracts;

use Illuminate\Http\Request;

interface Handler
{
    /**
     * Handle an incoming request
     * @param Request $request
     */
    public function handle(Request $request) : \Illuminate\View\View;
}
