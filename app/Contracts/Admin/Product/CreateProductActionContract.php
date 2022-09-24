<?php declare(strict_types=1);

namespace App\Contracts\Admin\Product;

use App\Models\Product;

interface CreateProductActionContract
{
    public function __invoke(array $productData): Product;
}
