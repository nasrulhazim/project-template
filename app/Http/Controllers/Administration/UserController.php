<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('viewAny', User::class);

        $sub = 'Manage user in the application';

        return view('administration.users.index', compact('sub'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): View
    {
        $user = User::where('uuid', $uuid)->firstOrfail();

        $this->authorize('view', $user);

        $roles = Role::whereNotIn('name', ['Superadmin', 'User'])->where('is_enabled', true)->get();
        $sub = 'Manage roles for user in the application';

        return view('administration.users.show', compact('user', 'roles', 'sub'));
    }
}
