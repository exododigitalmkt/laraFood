<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    private $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
        if (!$profile = $this->profile->find($idProfile))
            return redirect()->back();

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', [
            'profile' => $profile,
            'permissions' => $permissions,
        ]);
    }
    public function permissionsAvailable(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile))
            return redirect()->back();

        $filters = $request->except('_token');
       
        $permissions = $profile->permissionAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', [
            'profile' => $profile,
            'permissions' => $permissions,
            'filters' => $filters,
        ]);

    }
    public function attachPermissionsProfile(Request $request,$idProfile)
    {
        if (!$profile = $this->profile->find($idProfile))
            return redirect()->back();

        if (!$request->permissions || count($request->permissions) === 0)
            return redirect()
                    ->back()
                    ->with('warning', 'Precisa escolher pelo menos uma permissão');

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);
    }
    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission)
            return redirect()->back();

        $profile->permissions()->detach($permission);

        return redirect()->back();
    }

    public function profiles($idPermission)
    {
        if (!$permission = $this->permission->find($idPermission))
            return redirect()->back();

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', [
            'permission' => $permission,
            'profiles' => $profiles,
        ]);
    }
}
