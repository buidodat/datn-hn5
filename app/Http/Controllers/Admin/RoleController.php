<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.roles.';
    const PATH_UPLOAD = 'roles';
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                'name' => 'required|unique:roles',
                'permissions' => 'required'
            ]);

            $role = Role::create([
                'name' => $request->name,

            ]);
            $role->syncPermissions($request->permissions);

            return redirect()
                ->route('admin.roles.index')
                ->with('success', 'Thêm mới thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
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
    public function edit(Role $role)
    {
        //
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view(self::PATH_VIEW . __FUNCTION__, compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
        try {
            $request->validate([
                'name' => 'required|unique:roles,name,' . $role->id,
                'permissions' => 'required'
            ]);

            $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permissions);


            return redirect()
                ->route('admin.roles.index')
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        
        $role->delete();
        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Xóa thành công!');
    }
}
