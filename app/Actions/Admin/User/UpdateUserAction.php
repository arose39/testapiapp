<?php declare(strict_types=1);

namespace App\Actions\Admin\User;

use App\Contracts\Admin\User\UpdateUserActionContract;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction implements UpdateUserActionContract
{
    public function __invoke(User $user, array $userData): User
    {
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        if (!$userData['password'] == '') {
            $user->password = Hash::make($userData['password']);
        }
        if (!$user->save()) {
            throw new \ErrorException("Failed to update User");
        }

        return $user;
    }
}
