<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Order\CreateOrderActionContract;
use App\Actions\Admin\Order\UpdateOrderActionContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();

        return view('admin/orders/index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('admin/orders/create', [
            'users' => $users,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request, CreateOrderActionContract $action)
    {
        $orderData = $request->validated();
        $order = $action($orderData);

        return redirect()->back()->withSuccess("Order $order->id was successfully added");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $Order
     * @return \Illuminate\View\View
     */
    public function edit(Order $order)
    {
        $users = User::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('admin/orders/edit', [
            'order' => $order,
            'users' => $users,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param \App\Models\Order $Order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order, UpdateOrderActionContract $action)
    {
        $orderData = $request->validated();
        $action($order, $orderData);

        return redirect()->route('orders.index')->withSuccess("Order $order->id was updates");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $Order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order->delete()) {
            return redirect()->route('orders.index')->withSuccess("Order was deleted");
        }
    }
}
