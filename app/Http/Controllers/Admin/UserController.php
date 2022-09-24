<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\User\CreateUserAction;
use App\Actions\Admin\User\UpdateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('admin/users/index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \ErrorException
     */
    public function store(UserCreateRequest $request, CreateUserAction $action)
    {
        $userData = $request->validated();
        $user = $action($userData);

        return redirect()->back()->withSuccess("User $user->name was successfully added");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin/users/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws \ErrorException
     */
    public function update(UserUpdateRequest $request, User $user, UpdateUserAction $action)
    {
        $userData = $request->validated();
        $action($user, $userData);

        return redirect()->route('users.index')->withSuccess("User $user->name was updates");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('users.index')->withSuccess("User was deleted");
        }
    }
}
