<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\ProductLocalization;
use Illuminate\Database\Eloquent\Collection;

interface ProductLocalizationRepositoryInterface
{
    public function all(): Collection;

    public function getEnByProductId(string $productId): ProductLocalization;

    public function getUaByProductId(string $productId): ProductLocalization;

    public function create(string $productId, string $locale, string $name, string $description): ProductLocalization;

    public function update(string $productLocalizationId,  string $name, string $description): ProductLocalization;

    public function delete(string $productLocalizationId): bool;

    public function deleteByProductId(string $productId): bool;
}
