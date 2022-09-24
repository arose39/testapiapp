<?php declare(strict_types=1);

namespace App\Actions\Admin\Product;

use App\Contracts\Admin\Product\CreateProductGroupActionContract;
use App\Models\Product;

class CreateProductGroupAction implements CreateProductGroupActionContract
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
