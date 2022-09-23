<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function all(): Collection;

    public function getById(string $productId): Product;

    public function create(string $name, string $price): Product;

    public function update(string $productId, string $name, string $price): Product;

    public function delete(string $productId): bool;
}
