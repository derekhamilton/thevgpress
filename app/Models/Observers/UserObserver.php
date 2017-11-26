<?php
namespace App\Models\Observers;

use Illuminate\Contracts\Hashing\Hasher;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Alerts\Alert;
use Hash;

class UserObserver
{
    private $alert;
    private $hash;
    private $userRepo;

    public function __construct(Alert $alert, Hasher $hash, UserRepository $userRepo)
    {
        $this->alert = $alert;
        $this->hash = $hash;
        $this->userRepo = $userRepo;
    }

    public function creating($user)
    {
    }

    public function saving($user)
    {
        if (($validate = $user->validate()) === true) {
            if (!$user->id) {
                $user->password = $this->hash->make($this->userRepo->hashPassword($user->password));
                unset($user->password_confirmation);
            }
            return true;
        } else {
            foreach ($validate->toArray() as $field) {
                foreach ($field as $message) {
                    $this->alert->add('errors', $message);
                }
            }
            return false;
        }
    }
}
