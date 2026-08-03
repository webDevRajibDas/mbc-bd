<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('parent')->orderBy('id')->get();
        $grouped     = $permissions->groupBy(fn ($p) => $p->parent ?: 'Ungrouped');
        $parents     = $grouped->keys()->sort()->values();
        $total       = $permissions->count();

        return view('admin.access_control.permission.index', compact('grouped', 'parents', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = \DB::table('permissions')
            ->whereNotNull('parent')
            ->where('parent', '!=', '')
            ->distinct()
            ->orderBy('parent')
            ->pluck('parent');

        return view('admin.access_control.permission.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|unique:permissions,name',
            'parent' => 'nullable|string|max:191',
        ]);

        $name   = ucfirst(strtolower(trim($request->name)));
        $parent = $request->parent ? ucfirst(strtolower(trim($request->parent))) : null;

        $permission = Permission::create([
            'name'       => $name,
            'guard_name' => 'web',
        ]);

        \DB::table('permissions')->where('id', $permission->id)->update(['parent' => $parent]);

        \Toastr::success('Permission Added Successfully!', '', ["progressbar" => true]);
        return redirect()->route('permission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
