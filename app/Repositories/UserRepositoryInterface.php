<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function getById(string $userId): User;

    public function create(string $name, string $email, string $password): User;

    public function update(string $userId, string $name, string $email, string $password): User;

    public function delete(string $userId): bool;
}
