<?php declare(strict_types=1);

namespace App\Actions\Admin\Product;

use App\Models\Product;

class UpdateProductAction
{
    public function __invoke(Product $product ,array $productData): Product
    {
        $product->name = $productData['name'];
        $product->price = (float) $productData['price'];
        if (!$product->save()) {
            throw new \ErrorException("Failed to update Product");
        }

        return $product;
    }
}
