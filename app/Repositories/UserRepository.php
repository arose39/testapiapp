<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function all(): Collection
    {
        return User::orderBy('name')->get();
    }

    public function getById(string $userId): User
    {
        return User::find($userId);
    }

    public function create(string $name, string $email, string $password): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }

    public function update(string $userId, string $name, string $email, ?string $password): User
    {
        $updatedUser = User::find($userId);
        $updatedUser->name = $name;
        $updatedUser->email = $email;
        if (!$password == '') {
            $updatedUser->password = Hash::make($password);
        }
        if ($updatedUser->save()) {
            return $updatedUser;
        }
    }

    public function delete(string $userId): bool
    {
        return User::find($userId)->delete();
    }
}
