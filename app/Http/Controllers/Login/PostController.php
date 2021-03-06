<?php
namespace App\Http\Controllers\Login;

/**
 * Login Post
 */

use App\Http\Controllers\PageController;
use App\Repositories\UserRepository;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use RedisL;

/**
 * Handle login page and login modal
 */
class PostController extends PageController
{
    /**
     * login from both the login page and modal
     *
     * @return mixed
     * @param AuthManager    $auth
     * @param Request        $request
     * @param UserRepository $userRepo
     */
    public function post(AuthManager $auth, Request $request, UserRepository $userRepo)
    {
        $username    = $request->input('username');
        $password    = $userRepo->hashPassword($request->input('password'));
        $credentials = ['username' => $username, 'password' => $password];

        if ($auth->attempt($credentials, true)) {
            RedisL::hset('user-ids', $request->session()->getId(), $auth->user()->id);
        } else {
            $this->alert->add('errors.login-errors', 'Login Failed');
            return $this->response('login');
        }

        return $this->response('/');
    }
}
