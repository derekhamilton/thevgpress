<?php
namespace App\Http\Controllers\Profile;

use App\Http\Controllers\PageController;

class UserController extends PageController
{
    public function show()
    {
        return view('profile.user');
    }
}
