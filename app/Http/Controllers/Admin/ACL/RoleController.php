<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $repository;

    public function __construct(Role $role)
    {
        $this->repository = $role;

        $this->middleware(['can:roles']);
    }
   
    public function index()
    {
        $roles = $this->repository->paginate();

        return view('admin.pages.roles.index',[
            'roles' => $roles,
        ]);
    }
    public function create()
    {
        return view('admin.pages.roles.create');
    }
    public function store(StoreUpdateRole $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('roles.index');
    }
    public function show($id)
    {
        $role = $this->repository->find($id);

        if (!$role)
            return redirect()->back();

        return view('admin.pages.roles.show', [
            'role' => $role,
        ]);
    }
    public function edit($id)
    {
        $role = $this->repository->find($id);

        if (!$role)
            return redirect()->back();

        return view('admin.pages.roles.edit',[
            'role' => $role,
        ]);
    }
    public function update(StoreUpdateRole $request, $id)
    {
        $role = $this->repository->find($id);

        if (!$role)
            return redirect()->back();

        $role->update($request->all());
        
        return redirect()->route('roles.index');
    }
    public function destroy($id)
    {
        $role = $this->repository->find($id);

        if (!$role)
            return redirect()->back();

        $role->delete();

        return redirect()->route('roles.index');
    }
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $roles = $this->repository->search($request->filter);

        return view('admin.pages.roles.index', [
            'roles' => $roles,
            'filters' => $filters,
        ]);

    }
}
