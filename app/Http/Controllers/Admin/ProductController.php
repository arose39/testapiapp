<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductLocalizationRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ProductLocalizationRepositoryInterface $productLocalizationRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productRepository->all();
        return view('admin/product/index', ['products' => $products]);
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
        $product = $this->productRepository->create($request->name, $request->price);
        $productLocalizationEn = $this->productLocalizationRepository->create(
            $product->id,
            "en",
            $request->en_name,
            $request->en_description,
        );
        $productLocalizationUa = $this->productLocalizationRepository->create(
            $product->id,
            "ua",
            $request->ua_name,
            $request->ua_description,
        );

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
    public function edit(string $productId)
    {
        $product = $this->productRepository->getById($productId);
        $productLocalizationEn = $this->productLocalizationRepository->getEnByProductId($productId);
        $productLocalizationUa = $this->productLocalizationRepository->getUaByProductId($productId);
        return view('admin/products/edit', [
            'product' => $product,
            'productLocalizationEn' => $productLocalizationEn,
            'productLocalizationUa' => $productLocalizationUa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $productId)
    {
        $updatedProduct = $this->productRepository->update($productId, $request->name, $request->price);
        $this->productLocalizationRepository->update(
            $request->en_localization_id,
            $request->en_localization_name,
            $request->en_localization_description,
        );
        $this->productLocalizationRepository->update(
            $request->ua_localization_id,
            $request->ua_localization_name,
            $request->ua_localization_description,
        );
        if ($updatedProduct) {
            return redirect()->route('products.index')->withSuccess("product $updatedProduct->name was updates");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $productId)
    {
        if ($this->productRepository->delete($productId) && $this->productLocalizationRepository->deleteByProductId($productId)) {
            return redirect()->route('products.index')->withSuccess("Product was deleted");
        }
    }
}
