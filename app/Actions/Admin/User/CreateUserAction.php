<?php declare(strict_types=1);

namespace App\Actions\Admin\User;

use App\Contracts\Admin\User\CreateUserActionContract;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserAction implements CreateUserActionContract
{
    public function __invoke(array $userData): User
    {
        $user = new User();
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = Hash::make($userData['password']);
        if (!$user->save()) {
            throw new \ErrorException("Failed to save new User");
        }

        return $user;
    }
}
