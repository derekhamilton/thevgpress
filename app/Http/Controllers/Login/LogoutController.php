<?php
namespace App\Http\Controllers\Login;

/**
 * Logout
 */

use App\Http\Controllers\PageController;
use Illuminate\Auth\AuthManager;

/**
 * Handle login page and login modal
 */
class LogoutController extends PageController
{
    /**
     * log the user out
     *
     * @return mixed
     * @param AuthManager $auth
     */
    public function logout(AuthManager $auth)
    {
        $auth->logout();
        return $this->response();
    }
}
