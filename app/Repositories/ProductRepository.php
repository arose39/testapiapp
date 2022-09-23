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
        return Product::find($productId);
    }

    public function create(string $name, string $price): Product
    {
        $product = new Product();
        $product->name = $name;
        $product->price =  $price;
        if ($product->save()){
            return $product;
        }
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
