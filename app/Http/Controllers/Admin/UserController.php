<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Contracts\Admin\User\CreateUserActionContract;
use App\Contracts\Admin\User\UpdateUserActionContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('name')->get();

        return view('admin/users/index', ['users' => $users]);
    }

    public function create(): View
    {
        return view('admin/users/create');
    }

    public function store(UserCreateRequest $request, CreateUserActionContract $action): RedirectResponse
    {
        $userData = $request->validated();
        $user = $action($userData);

        return redirect()->back()->withSuccess("User $user->name was successfully added");
    }

    public function edit(User $user): View
    {
        return view('admin/users/edit', ['user' => $user]);
    }

    public function update(UserUpdateRequest $request, User $user, UpdateUserActionContract $action): RedirectResponse
    {
        $userData = $request->validated();
        $action($user, $userData);

        return redirect()->route('users.index')->withSuccess("User $user->name was updates");
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->delete()) {
            return redirect()->route('users.index')->withSuccess("User was deleted");
        }
    }
}
