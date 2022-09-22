<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showPannel()
    {
        $numberUsersRegistrations = User::all()->count();
        return view('admin/admin', ['numberUsersRegistrations' => $numberUsersRegistrations]);
    }
}
