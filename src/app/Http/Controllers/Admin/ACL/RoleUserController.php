<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    private $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;

        $this->middleware(['can:users']);
    }

    public function roles($idUser)
    {
        if (!$user = $this->user->find($idUser))
            return redirect()->back();

        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.roles', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }
    public function rolesAvailable(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser))
            return redirect()->back();

        $filters = $request->except('_token');
       
        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.available', [
            'user' => $user,
            'roles' => $roles,
            'filters' => $filters,
        ]);

    }
    public function attachRolesUser(Request $request,$idUser)
    {
        if (!$user = $this->user->find($idUser))
            return redirect()->back();

        if (!$request->roles || count($request->roles) === 0)
            return redirect()
                    ->back()
                    ->with('warning', 'Precisa escolher pelo menos um usero');

        $user->roles()->attach($request->roles);

        return redirect()->route('users.roles', $user->id);
    }
    public function detachRoleUser($idUser, $idPermission)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idPermission);

        if (!$user || !$role)
            return redirect()->back();

        $user->roles()->detach($role);

        return redirect()->back();
    }

    public function users($idPermission)
    {
        if (!$role = $this->role->find($idPermission))
            return redirect()->back();

        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.users', [
            'role' => $role,
            'users' => $users,
        ]);
    }
}
