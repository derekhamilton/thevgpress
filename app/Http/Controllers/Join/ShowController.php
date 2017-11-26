<?php
namespace App\Http\Controllers\Join;

/**
 * Join Page controller
 */

use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use App\Http\Controllers\PageController;
use App\Repositories\UserRepository;

/**
 * Registration form for new users
 */
final class ShowController extends PageController
{
    /**
     * Registration form
     * @param UserRepository $userRepo
     * @return \Illuminate\View\View
     */
    public function show(UserRepository $userRepo)
    {
        $username = 'testing';
        $password = $userRepo->hashPassword('testing1');
        $credentials = array('username' => $username, 'password' => $password);
        return view('join');
    }
}
