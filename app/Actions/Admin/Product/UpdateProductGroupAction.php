<?php declare(strict_types=1);

namespace App\Actions\Admin\Product;

use App\Models\Product;

class UpdateProductGroupAction
{
    public function __construct(
        private UpdateProductAction $updateProductAction,
        private UpdateProductLocalizationsAction $updateProductLocalizationsAction
    )
    {
    }

    public function __invoke(Product $product , array $productWithLocalizationsData): Product
    {
        $product = ($this->updateProductAction)($product ,$productWithLocalizationsData);
        ($this->updateProductLocalizationsAction)($product, $productWithLocalizationsData['localizations']);

        return $product;
    }
}
