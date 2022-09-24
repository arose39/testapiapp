<?php declare(strict_types=1);

namespace App\Actions\Admin\Product;

use App\Contracts\Admin\Product\CreateProductActionContract;
use App\Models\Product;

class CreateProductAction implements CreateProductActionContract
{
    public function __invoke(array $productData): Product
    {
        $product = new Product();
        $product->name = $productData['name'];
        $product->price = (float) $productData['price'];
        if (!$product->save()) {
            throw new \ErrorException("Failed to save new Product");
        }

        return $product;
    }
}
