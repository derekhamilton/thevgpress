<?php
namespace App\Http\Controllers\Forum\Board\New;

use App\Http\Controllers\PageController;

class ShowController extends PageController
{
    public function show()
    {
        return view('forum-board-new', [
        ]);
    }
}
