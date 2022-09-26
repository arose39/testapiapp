<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function showPanel(): View
    {
        return view('admin/admin', [
            'numberUsersRegistrations' => User::all()->count(),
            'numberProducts' => Product::all()->count(),
            'numberOrders' => Order::all()->count(),
        ]);
    }
}
