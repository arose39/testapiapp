<?php declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllProductCollection;
use App\Http\Resources\OneProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;


class ProductController extends Controller
{
    public function index(): AllProductCollection
    {
        return new AllProductCollection(Product::orderBy('name')->paginate(10));
    }

    public function show(Product $product): OneProductResource
    {
        return new OneProductResource($product);
    }

    public function makeOrder(int $productId): JsonResponse
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->product_id = $productId;
        $order->save();

        return new JsonResponse("You order was created. Order id: $order->id", Response::HTTP_OK);
    }
}
