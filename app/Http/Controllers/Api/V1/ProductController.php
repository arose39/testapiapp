<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllProductCollection;
use App\Http\Resources\OneProductResource;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        return new AllProductCollection(Product::orderBy('name')->paginate(10));
    }

    public function show($locale, Product $product)
    {
        return new OneProductResource($product) ;
    }

    public function makeOrder( $productId)
    {
        return $productId;
    }
}
