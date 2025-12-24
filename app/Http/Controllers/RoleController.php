<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        $permissions = Permission::all();

        return view('admin.roles.index', compact('roles', 'permissions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create([
            'name' => $request->get('name'),
            'title' => $request->get('title') ?? 'null',
        ]);

        $permissions = $request->get('permissions');

        if ($permissions) {
            $permissionModels = \Spatie\Permission\Models\Permission::whereIn('id', $permissions)->get();
            $role->syncPermissions($permissionModels);
        }


        return redirect()->route('roles.index')->with('success', 'Role muvaffaqiyatli qo`shildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findById($id);

        abort_if($role->name == 'Super Admin' && !auth()->user()->hasRole('Super Admin'), 403);
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id,
            'title' => 'required|string|max:255',
        ]);

        $permissions = $request->get('permissions', []);
        unset($request['permissions']);

        $role = Role::findById($id);

        abort_if($role->name === 'Super Admin' && !auth()->user()->hasRole('Super Admin'), 403);

        $role->fill($request->all());
        $role->save();

        $permissionModels = Permission::whereIn('id', $permissions)->get();
        $role->syncPermissions($permissionModels);

        return redirect()->route('roles.index')->with('success', 'Role muvaffaqiyatli tahrirlandi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $role = Role::findById($id);

        if ($role->name == 'admin') {
            return redirect()->back()->with('danger', 'Siz admini rolini o`chira olmaysiz');
        }
        DB::table('model_has_roles')->where('role_id', $id)->delete();
        DB::table('role_has_permissions')->where('role_id', $id)->delete();
        $role->delete();
        return redirect()->back()->with('success', 'Role muvaffaqiyatli o`chirildi');
    }
}
