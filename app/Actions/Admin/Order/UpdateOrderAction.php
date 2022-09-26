<?php declare(strict_types=1);

namespace App\Actions\Admin\Order;

use App\Contracts\Admin\Order\UpdateOrderActionContract;
use App\Models\Order;

class UpdateOrderAction implements UpdateOrderActionContract
{
    public function __invoke(Order $order, array $orderData): Order
    {
        $order->user_id = $orderData['user_id'];
        $order->product_id = $orderData['product_id'];
        if (!$order->save()) {
            throw new \ErrorException("Failed to update Order");
        }

        return $order;
    }
}
