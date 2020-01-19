<?php
namespace App\Services\Get\Profile;

use App\Queries\Forum\Topic\BlogsByUserId;
use App\Queries\Forum\Topic\MostRecentUserBlog;
use App\Queries\Users\UserByUsername;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserService
{
    private $userByUsername;
    private $mostRecentUserBlog;
    private $blogsByUserId;

    public function __construct(
        UserByUsername $userByUsername,
        MostRecentUserBlog $mostRecentUserBlog,
        BlogsByUserId $blogsByUserId
    ) {
        $this->userByUsername     = $userByUsername;
        $this->mostRecentUserBlog = $mostRecentUserBlog;
        $this->blogsByUserId      = $blogsByUserId;
    }

    public function get(Request $request): Collection
    {
        $username = $request->route('username');
        $user     = $this->userByUsername->query($username);
        $blog     = $this->mostRecentUserBlog->query($user->id);
        $blogs    = $this->blogsByUserId->query($user->id);

        return collect([
            'user'  => $user,
            'blog'  => $blog,
            'blogs' => $blogs,
        ]);
    }
}
