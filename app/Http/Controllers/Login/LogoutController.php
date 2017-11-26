<?php
namespace App\Http\Controllers\Login;

/**
 * Logout
 */

use Illuminate\Auth\AuthManager;
use App\Http\Controllers\PageController;

/**
 * Handle login page and login modal
 */
class LogoutController extends PageController
{
    /**
     * log the user out
     *
     * @return mixed
     */
    public function logout(AuthManager $auth)
    {
        $auth->logout();
        return $this->response();
    }
}
