<?php
namespace App\Contracts;

use Illuminate\Http\Request;

interface Handler
{
    /**
     * Handle an incoming request
     */
    public function handle(Request $request) : \Illuminate\View\View;
}
