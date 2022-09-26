<?php declare(strict_types=1);

namespace App\Contracts\Admin\Product;

use App\Models\Product;

interface CreateProductLocalizationsActionContract
{
    public function __invoke(Product $product, array $localizations): array;
}
