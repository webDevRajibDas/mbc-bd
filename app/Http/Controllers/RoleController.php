<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'roles' => Role::latest('id')->get(),
        ];
        return view( 'admin.access_control.role.index', $data);
    }


    public function create()
    {

        $data = [
            'model' => new Role,
            'permission_groups' => Permission::all()->groupBy('parent'),
        ];

        return view( 'admin.access_control.role.create', $data);

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
//        $role->syncPermissions($request->input('permission'));

        $numericPermissionArray = [];
        foreach($request->permission as $permission) {
            $numericPermissionArray[] = intval($permission);
        }

        $role->syncPermissions($numericPermissionArray);

        \Toastr::success('Role Information Created Successfully!', '', ["progressbar" => true]);
        return redirect()->route('role.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Role $role)
    {

        $data = [
            'model' => $role,
            'all_permissions' => Permission::all()->count(),
            'permission_groups' => Permission::all()->groupBy('parent'),
            'rolePermissions' => DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all(),

        ];
        return view( 'admin.access_control.role.edit', $data);
    }

    public function update(Request $request, Role $role)
    {

        $request->validate([
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($role->id),
            ],
        ]);

        $role->name = $request->input('name');
        $role->save();

        $numericPermissionArray = [];
        foreach($request->permission ?? [] as $permission) {
            $numericPermissionArray[] = intval($permission);
        }

        $role->syncPermissions($numericPermissionArray);

        \Toastr::success('Role Information Updated Successfully!', '', ["progressbar" => true]);
        return redirect()->route('role.index');
    }

    public function destroy($id)
    {
        //
    }
}
