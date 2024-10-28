<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AssignRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.assign-roles.';
    const PATH_UPLOAD = 'assign-roles';
    public function index()
    {
        //
        $users = User::where('type', 'admin')->with('roles')->get(); // Lấy danh sách người dùng cùng với vai trò
        $roles = Role::all(); // Lấy tất cả các vai trò
        return view(self::PATH_VIEW . __FUNCTION__,  compact('users', 'roles'));
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
    public function update(Request $request, User $user)
    {
        //
        try {

            // $user = User::find($user->id);
            // $roles = Role::find($request->role_id);
            // $user->syncRoles($request->role_id);

            // $roleNames = Role::whereIn('id', $request->role_id)->pluck('name')->toArray();
            // $user->assignRole($roleNames);
            // $user->syncRoles($roleNames);

          
            DB::table('model_has_roles')->update([
                'role_id' => $request->role_id,
                'model_type' => 'App\Models\User',
                'model_id' => $user->id
            ]);

            return redirect()
                ->back()
                ->with('success', 'Gán vai trò thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
