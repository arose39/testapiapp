<?php declare(strict_types=1);

namespace App\Actions\Admin\Product;

use App\Models\Product;

class CreateProductGroupAction
{
    public function __construct(
        private CreateProductAction $createProductAction,
        private CreateProductLocalizationsAction $createProductLocalizationsAction
    )
    {
    }

    public function __invoke(array $productWithLocalizationsData): Product
    {
        $product = ($this->createProductAction)($productWithLocalizationsData);
        ($this->createProductLocalizationsAction)($product, $productWithLocalizationsData['localizations']);

        return $product;
    }
}
