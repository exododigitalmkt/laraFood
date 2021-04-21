<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;
    }
   
    public function index()
    {
        $users = $this->repository->latest()->tenantFilter()->paginate();

        return view('admin.pages.users.index',[
            'users' => $users,
        ]);
    }
    public function create()
    {
        return view('admin.pages.users.create');
    }
    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']);

        $this->repository->create($data);

        return redirect()->route('users.index');
    }
    public function show($id)
    {
        $user = $this->repository->tenantFilter()->find($id);

        if (!$user)
            return redirect()->back();

        return view('admin.pages.users.show', [
            'user' => $user,
        ]);
    }
    public function edit($id)
    {
        $user = $this->repository->tenantFilter()->find($id);

        if (!$user)
            return redirect()->back();

        return view('admin.pages.users.edit',[
            'user' => $user,
        ]);
    }
    public function update(StoreUpdateUser $request, $id)
    {
        $user = $this->repository->tenantFilter()->find($id);

        if (!$user)
            return redirect()->back();

        $data = $request->only(['name', 'email']);

        if ($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        
        return redirect()->route('users.index');
    }
    public function destroy($id)
    {
        $user = $this->repository->tenantFilter()->find($id);

        if (!$user)
            return redirect()->back();
        
        if($id == auth()->user()->id){
            return redirect()->route('users.index')->with('warning', 'Você não pode remover seu próprio usuário.');
        }

        $user->delete();

        return redirect()->route('users.index');
    }
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $users = $this->repository->search($request->filter);

        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => $filters,
        ]);

    }
}
