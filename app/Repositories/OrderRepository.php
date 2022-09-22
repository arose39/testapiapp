<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;


class OrderRepository implements OrderRepositoryInterface
{
    public function all(): Collection
    {
        return Order::orderBy('name')->get();
    }

    public function getById(string $orderId): Order
    {
        return Order::find($orderId);
    }

    public function create(string $userId, string $productId): Order
    {
        return Order::create([
            'user_id' => $userId,
            'product_id' => $productId,

        ]);
    }

    public function update(string $orderId, string $userId, string $productId): Product
    {
        $updatedOrder = Order::find($orderId);
        $updatedOrder->userId = $userId;
        $updatedOrder->productId = $productId;
        if ($updatedOrder->save()) {
            return $updatedOrder;
        }
    }

    public function delete(string $orderId): bool
    {
        return Order::find($userId)->delete();
    }
}
