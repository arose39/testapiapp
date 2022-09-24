<?php declare(strict_types=1);

namespace App\Actions\Admin\Order;

use App\Models\Order;

class CreateOrderAction
{
    public function __invoke(array $orderData): Order
    {
        $order = new Order();
        $order->user_id = $orderData['user_id'];
        $order->product_id = $orderData['product_id'];
        if (!$order->save()) {
            throw new \ErrorException("Failed to save new Order");
        }

        return $order;
    }
}
