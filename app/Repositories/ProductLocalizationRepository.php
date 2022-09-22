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

    public function getById(string $productLocalizationId): ProductLocalization
    {
        return ProductLocalization::find($productLocalizationId);
    }

    public function create(string $productId, string $locale, string $name, string $description): ProductLocalization
    {
        return ProductLocalization::create([
            'product_id' => $productId,
            'locale' => $locale,
            'name' => $name,
            'description' => $description,
        ]);
    }

    public function update(string $productLocalizationId, string $locale, string $name, string $description): ProductLocalization
    {
        $updatedProductLocalization = ProductLocalization::find($productLocalizationId);
        $updatedProductLocalization->locale = $locale;
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
}
