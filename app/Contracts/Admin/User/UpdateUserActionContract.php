<?php declare(strict_types=1);

namespace App\Contracts\Admin\User;

use App\Models\User;

interface UpdateUserActionContract
{
    public function __invoke(User $user, array $orderData): User;
}
