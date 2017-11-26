<?php
namespace App\Http\Controllers;

use App\Models\ForumBoard;

class HomeController extends PageController
{
    public function show()
    {
        return view('index');
    }
}
