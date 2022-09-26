<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Contracts\Admin\Product\CreateProductGroupActionContract;
use App\Contracts\Admin\Product\UpdateProductGroupActionContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductWithLocalizationRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin/products/index', [
            'products' => Product::orderBy('name')->get(),
            'locale' => app()->getLocale(),
        ]);
    }

    public function show(Product $product): View
    {
        return view('admin/products/show', [
            'product' => $product,
            'locale' => app()->getLocale(),
        ]);
    }

    public function create(): View
    {
        return view('admin/products/create');
    }

    public function store(ProductWithLocalizationRequest $request, CreateProductGroupActionContract $action): RedirectResponse
    {
        $productWithLocalizationsData = $request->validated();
        $product = $action($productWithLocalizationsData);

        return redirect()->back()->withSuccess("Product $product->name was successfully added");
    }

    public function edit(Product $product): View
    {
        return view('admin/products/edit', ['product' => $product]);
    }

    public function update(
        ProductWithLocalizationRequest $request,
        Product $product,
        UpdateProductGroupActionContract $action
    ): RedirectResponse
    {
        $productWithLocalizationsData = $request->validated();
        $action($product, $productWithLocalizationsData);

        return redirect()->route('products.index')->withSuccess("product $product->name was updates");
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->delete()) {
            return redirect()->route('products.index')->withSuccess("Product was deleted");
        }
    }
}
