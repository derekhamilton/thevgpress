<?php
namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends PageController
{
    public function show(): View
    {
        return view('index');
    }
}
