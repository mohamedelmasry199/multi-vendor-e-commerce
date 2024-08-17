<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('check_permission:show_roles')->only('index');
        $this->middleware('check_permission:add_roles')->only('store');
        $this->middleware('check_permission:update_roles')->only( 'update');
        $this->middleware('check_permission:delete_roles')->only(['destroy']);
    }
    public function index()
    {
        $roles = Role::withCount('users')->with('permissions')->get();
        $permissions = Permission::where('guard_name','admin')->get();
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $data= $request->validated();
        $role=Role::create(['name'=>$data['role_name'],'guard_name'=>'admin']);
        if(isset($data['permissions'])){
            foreach($data['permissions'] as $permission=>$value){
                $role->givePermissionTo($value);
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $data= $request->validated();
        $role=Role::findOrFail($id);
        $role->update(['name'=>$data['role_name']]);
        $role->syncPermissions();
        if(isset($data['permissions'])){
            foreach($data['permissions'] as $permission=>$value){
                $role->givePermissionTo($value);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
