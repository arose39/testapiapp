<?php declare(strict_types=1);

namespace App\Actions\Admin\Product;

use App\Models\Product;
use App\Models\ProductLocalization;

class CreateProductLocalizationsAction
{
    public function __invoke(Product $product, array $localizations): array
    {
        $localizationsCollection = [];
        foreach ($localizations as $localization => $data) {
            $productLocalization = new ProductLocalization();
            $productLocalization->product_id = $product->id;
            $productLocalization->locale = $localization;
            $productLocalization->name = $data['name'];
            $productLocalization->description = $data['description'];
            if (!$productLocalization->save()) {
                throw new \ErrorException("Failed to save new ProductLocalization");
            }
            $localizationsCollection[] = $productLocalization;
        }

        return $localizationsCollection;
    }
}
