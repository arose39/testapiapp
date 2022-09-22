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

    public function getEnByProductId(string $productId): ProductLocalization
    {
        return ProductLocalization::findBy(['product_id'=>$productId, 'locale'=>'en']);
    }

    public function getUaByProductId(string $productId): ProductLocalization
    {
        return ProductLocalization::findBy(['product_id'=>$productId, 'locale'=>'ua']);
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

    public function update(string $productLocalizationId,  string $name, string $description): ProductLocalization
    {
        $updatedProductLocalization = ProductLocalization::find($productLocalizationId);
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
