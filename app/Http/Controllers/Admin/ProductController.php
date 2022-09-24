<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Product\CreateProductGroupAction;
use App\Actions\Admin\Product\UpdateProductGroupAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductWithLocalizationRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::orderBy('name')->get();

        return view('admin/products/index', ['products' => $products]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('admin/products/show', ['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/products/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductWithLocalizationRequest $request, CreateProductGroupAction $action)
    {
        $productWithLocalizationsData = $request->validated();
        $product = $action($productWithLocalizationsData);

        return redirect()->back()->withSuccess("Product $product->name was successfully added");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('admin/products/edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(ProductWithLocalizationRequest $request, Product $product, UpdateProductGroupAction $action)
    {
        $productWithLocalizationsData = $request->validated();
        $action($product, $productWithLocalizationsData);

        return redirect()->route('products.index')->withSuccess("product $product->name was updates");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return redirect()->route('products.index')->withSuccess("Product was deleted");
        }
    }
}
