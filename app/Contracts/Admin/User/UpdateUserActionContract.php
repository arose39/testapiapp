<?php declare(strict_types=1);

namespace App\Contracts\Admin\User;

use App\Models\Order;

interface UpdateUserActionContract
{
    public function __invoke(Order $order, array $orderData): Order;
}
