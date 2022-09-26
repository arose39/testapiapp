<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Contracts\Admin\Order\CreateOrderActionContract;
use App\Contracts\Admin\Order\UpdateOrderActionContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();

        return view('admin/orders/index', ['orders' => $orders]);
    }

    public function create(): View
    {
        $users = User::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('admin/orders/create', [
            'users' => $users,
            'products' => $products,
        ]);
    }

    public function store(OrderRequest $request, CreateOrderActionContract $action): RedirectResponse
    {
        $orderData = $request->validated();
        $order = $action($orderData);

        return redirect()->back()->withSuccess("Order $order->id was successfully added");
    }

    public function edit(Order $order): View
    {
        $users = User::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('admin/orders/edit', [
            'order' => $order,
            'users' => $users,
            'products' => $products,
        ]);
    }

    public function update(OrderRequest $request, Order $order, UpdateOrderActionContract $action): RedirectResponse
    {
        $orderData = $request->validated();
        $action($order, $orderData);

        return redirect()->route('orders.index')->withSuccess("Order $order->id was updates");
    }

    public function destroy(Order $order): RedirectResponse
    {
        if ($order->delete()) {
            return redirect()->route('orders.index')->withSuccess("Order was deleted");
        }
    }
}
