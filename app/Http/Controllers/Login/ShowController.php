<?php
namespace App\Http\Controllers\Login;

/**
 * Login Show
 */
use App\Http\Controllers\PageController;

/**
 * Handle login page and login modal
 */
class ShowController extends PageController
{
    /**
     * login page
     */
    public function show()
    {
        return view('login');
    }
}
