<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Contracts\Admin\Product\CreateProductGroupActionContract;
use App\Contracts\Admin\Product\UpdateProductGroupActionContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductWithLocalizationRequest;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('name')->get();

        return view('admin/products/index', ['products' => $products]);
    }

    public function show(Product $product): View
    {
        return view('admin/products/show', ['product' => $product]);
    }

    public function create(): View
    {
        return view('admin/products/create');
    }

    public function store(ProductWithLocalizationRequest $request, CreateProductGroupActionContract $action): Response
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
    ): Response
    {
        $productWithLocalizationsData = $request->validated();
        $action($product, $productWithLocalizationsData);

        return redirect()->route('products.index')->withSuccess("product $product->name was updates");
    }

    public function destroy(Product $product): Response
    {
        if ($product->delete()) {
            return redirect()->route('products.index')->withSuccess("Product was deleted");
        }
    }
}
