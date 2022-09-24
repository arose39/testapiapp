<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function showPannel(): View
    {
        $numberUsersRegistrations = User::all()->count();
        return view('admin/admin', ['numberUsersRegistrations' => $numberUsersRegistrations]);
    }
}
