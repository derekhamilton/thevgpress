<?php
namespace App\Http\Controllers\Profile;

use App\Http\Controllers\PageController;
use App\Services\Get\Profile\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends PageController
{
    public function show(Request $request, UserService $service): View
    {
        return view('profile.user', $service->get($request)->all());
    }
}
