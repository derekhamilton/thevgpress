<?php
namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\ForumBoard;

class HomeController extends PageController
{
    public function show()
    {
        return view('index');
    }
}
