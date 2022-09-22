<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    public function all(): Collection;

    public function getById(string $orderId): Order;

    public function create(string $userId, string $productId): Order;

    public function update(string $orderId, string $userId, string $productId): Order;

    public function delete(string $orderId): bool;
}
