<?php declare(strict_types=1);

namespace App\Contracts\Admin\Product;

use App\Models\Product;

interface UpdateProductGroupActionContract
{
    public function __invoke(Product $product , array $productWithLocalizationsData): Product;
}
