<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class AccessControlController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Role::class);

        $sub = 'Manage access in the application';

        return view('security.access-control.index', compact('sub'));
    }

    public function show(Request $reqeust, string $uuid)
    {
        $role = Role::where('uuid', $uuid)->with('permissions')->firstOrFail();

        $this->authorize('view', $role);
        $sub = 'Manage roles in the application';

        $permissions = Permission::where('is_enabled', true)->get()->groupBy('module');

        return view('security.access-control.show', compact('role', 'permissions'));
    }
}
