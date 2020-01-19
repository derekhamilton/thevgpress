<?php
namespace App\Http\Controllers\Profile;

use App\Http\Controllers\PageController;
use App\Services\Get\Profile\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends PageController
{
    /**
     * __construct
     */
    public function __construct()
    {
    }

    /**
     * @param Request     $request
     * @param UserService $service
     * @return View
     */
    public function show(Request $request, UserService $service): View
    {
        return view('profile.user', $service->get($request)->all());
    }
}
