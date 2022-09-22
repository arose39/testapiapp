<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::orderBy('name')->get();
    }

    public function getById(string $productId): Product
    {
        return Product::find($userId);
    }

    public function create(string $name, int $price): Product
    {
        return Product::create([
            'name' => $name,
            'price' => $price,
        ]);
    }

    public function update(string $productId, string $name, string $price): Product
    {
        $updatedProduct = Product::find($productId);
        $updatedProduct->name = $name;
        $updatedProduct->price = $price;
        if ($updatedProduct->save()) {
            return $updatedProduct;
        }
    }

    public function delete(string $productId): bool
    {
        return Product::find($productId)->delete();
    }
}
