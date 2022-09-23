<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductLocalization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        $localizations = $request->get('localizations');
        foreach ($localizations as $localization => $data) {
            $productLocalization = new ProductLocalization();
            $productLocalization->product_id = $product->id;
            $productLocalization->locale = $localization;
            $productLocalization->name = $data['name'];
            $productLocalization->description = $data['description'];
            $productLocalization->save();
        }

        if ($product) {
            return redirect()->back()->withSuccess("Product $product->name was successfully added");
        }
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
    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        $localizations = $request->get('localizations');
        foreach ($localizations as $localization => $data) {
            $updatedProductLocalization = ProductLocalization::where(['product_id' => $product->id], ['locale' => $localization])->first();
            $updatedProductLocalization->name = $request->name;
            $updatedProductLocalization->description = $request->description;
            $updatedProductLocalization->save();
        }

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
