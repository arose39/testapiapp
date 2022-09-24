<?php declare(strict_types=1);

namespace App\Actions\Admin\Product;

use App\Models\Product;
use App\Models\ProductLocalization;

class UpdateProductLocalizationsAction
{
    public function __invoke(Product $product, array $localizations): array
    {
        $localizationsCollection = [];

        foreach ($localizations as $localization => $data) {
            $updatedProductLocalization = ProductLocalization::where(['product_id' => $product->id], ['locale' => $localization])->first();
            $updatedProductLocalization->name = $data['name'];
            $updatedProductLocalization->description = $data['description'];
            if (!$updatedProductLocalization->save()) {
                throw new \ErrorException("Failed to Update ProductLocalization");
            }
            $localizationsCollection[] = $updatedProductLocalization;
        }

        return $localizationsCollection;
    }
}
