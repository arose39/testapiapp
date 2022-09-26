<?php declare(strict_types=1);

namespace App\Contracts\Admin\Order;

use App\Models\Order;

interface UpdateOrderActionContract
{
    public function __invoke(Order $order, array $orderData): Order;
}
