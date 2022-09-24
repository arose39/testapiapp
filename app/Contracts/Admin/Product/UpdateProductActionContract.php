<?php declare(strict_types=1);

namespace App\Contracts\Admin\Product;

use App\Models\Product;

interface UpdateProductActionContract
{
    public function __invoke(Product $product ,array $productData): Product;
}
