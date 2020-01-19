<?php
namespace App\Repositories;

class UserRepository extends AbstractEloquentRepository implements RepositoryInterface
{
    protected $modelClassName = \App\Models\User::class;

    /**
     * Legacy function for hashing passwords
     * @return string
     * @param mixed $password
     */
    public function hashPassword($password)
    {
        return sha1(env('LEGACY_SALT_1')." ".md5(sha1($password))." ".env('LEGACY_SALT_2'));
    }

    public function create($input)
    {
        $user                        = new $this->modelClassName($input);
        $user->password_confirmation = $input['password_confirmation'];
        $success                     = $user->save();

        return $success ? $user : false;
    }
}
