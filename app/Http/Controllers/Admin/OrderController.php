<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderRepositoryInterface $orderRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = $this->orderRepository->all();
        return view('admin/orders/index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/orders/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = $this->orderRepository->create($request->name, $request->email, $request->password);
        if ($order) {
            return redirect()->back()->withSuccess("Order $order->id was successfully added");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function edit(string $orderId)
    {
        $order = $this->orderRepository->getById($orderId);
        return view('admin/orders/edit', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $orderId)
    {
        $updatedUser = $this->orderRepository->update($orderId, $request->name, $request->email, $request->password);
        if ($updatedUser) {
            return redirect()->route('orders.index')->withSuccess("Order $updatedUser->name was updates");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $orderId)
    {
        if ($this->orderRepository->delete($orderId)) {
            return redirect()->route('orders.index')->withSuccess("Order was deleted");
        }
    }
}
