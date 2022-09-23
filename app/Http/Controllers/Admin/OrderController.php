<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders =  Order::orderBy('created_at', 'DESC')->get();

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
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->product_id = $request->product_id;

        if ($order->save()) {
            return redirect()->back()->withSuccess("Order $order->id was successfully added");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        $order->user_id = $request->user_id;
        $order->product_id = $request->product_id;
        $order->save();
//        if () {
            return redirect()->route('orders.index')->withSuccess("Order $order->id was updates");
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order->delete()) {
            return redirect()->route('orders.index')->withSuccess("Order was deleted");
        }
    }
}
