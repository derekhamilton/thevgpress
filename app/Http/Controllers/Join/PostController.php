<?php
namespace App\Http\Controllers\Join;

/**
 * Join Post controller
 */

use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use App\Http\Controllers\PageController;
use App\Repositories\UserRepository;

/**
 * Registration form for new users
 */
final class PostController extends PageController
{
    /**
     * process registration form
     * @param AuthManager    $auth
     * @param Request        $request
     * @param UserRepository $userRepo
     * @return \Illuminate\Http\Response
     */
    public function post(AuthManager $auth, Request $request, UserRepository $userRepo)
    {
        $user = $userRepo->create($request->all());
        if (!$user) {
            return $this->response('join');
        }

        $this->alert->add('successes', 'Signup Successful.  Welcome to The VG Press!');

        $auth->login($user);

        return $this->response('/');
    }
}
