<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\ProductLocalization;
use Illuminate\Database\Eloquent\Collection;

class ProductLocalizationRepository implements ProductLocalizationRepositoryInterface
{
    public function all(): Collection
    {
        return ProductLocalization::orderBy('name')->get();
    }

    public function create(string $productId, string $locale, string $name, string $description): ProductLocalization
    {
        $productLocalization = new ProductLocalization();
        $productLocalization->product_id = $productId;
        $productLocalization->locale = $locale;
        $productLocalization->name = $name;
        $productLocalization->description = $description;

        if ($productLocalization->save()) {
            return $productLocalization;
        }
    }

    public function update(string $productId, string $locale, string $name, string $description): ProductLocalization
    {
        $updatedProductLocalization = ProductLocalization::where(['product_id' => $productId], ['locale' => $locale])->first();
        $updatedProductLocalization->name = $name;
        $updatedProductLocalization->description = $description;

        if ($updatedProductLocalization->save()) {
            return $updatedProductLocalization;
        }
    }

    public function delete(string $productLocalizationId): bool
    {
        return ProductLocalization::find($productLocalizationId)->delete();
    }

    public function deleteByProductId(string $productId): bool
    {
        return ProductLocalization::findBy($productId)->delete();
    }
}
