<?php declare(strict_types=1);

namespace App\Contracts\Admin\Order;

use App\Models\Order;

interface CreateOrderActionContract
{
    public function __invoke(array $orderData): Order;
}
