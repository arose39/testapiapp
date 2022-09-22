<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\ProductLocalization;
use Illuminate\Database\Eloquent\Collection;

interface ProductLocalizationRepositoryInterface
{
    public function all(): Collection;

    public function getById(string $productLocalizationId): ProductLocalization;

    public function create(string $productId, string $locale, string $name, string $description): ProductLocalization;

    public function update(string $productLocalizationId, string $locale, string $name, string $description): ProductLocalization;

    public function delete(string $productLocalizationId): bool;
}
