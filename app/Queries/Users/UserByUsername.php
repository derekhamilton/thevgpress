<?php
namespace App\Queries\Users;

use App\Models\User;

class UserByUsername
{
    public function query($username): ?User
    {
        return User::where('username', $username)->first();
    }
}
