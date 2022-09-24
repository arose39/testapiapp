<?php declare(strict_types=1);

namespace App\Contracts\Admin\User;

use App\Models\User;

interface CreateUserActionContract
{
    public function __invoke(array $userData): User;
}
