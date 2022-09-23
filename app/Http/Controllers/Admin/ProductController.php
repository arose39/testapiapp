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
        return view('admin/products/index', ['products' => $products]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(string $productId)
    {
        $product = $this->productRepository->getById($productId);
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
        $product = $this->productRepository->create($request->name, $request->price);
        $localizations = $request->get('localizations');
        foreach ($localizations as $localization => $data) {
            $this->productLocalizationRepository->create(
                $product->id,
                $localization,
                $data['name'],
                $data['description']
            );
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
    public function edit(string $productId)
    {
        $product = $this->productRepository->getById($productId);

        return view('admin/products/edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $productId)
    {
        $updatedProduct = $this->productRepository->update($productId, $request->name, $request->price);
        $localizations = $request->get('localizations');
        foreach ($localizations as $localization => $data) {
            $this->productLocalizationRepository->update(
                $updatedProduct->id,
                $localization,
                $data['name'],
                $data['description']
            );
        }
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
        if ($this->productRepository->delete($productId)) {
            return redirect()->route('products.index')->withSuccess("Product was deleted");
        }
    }
}
