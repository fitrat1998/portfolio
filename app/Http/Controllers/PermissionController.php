<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('roles')->get();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions'
        ]);

        $permission = Permission::create([
            'name' => $request->get('name'),
            'title' => $request->get('title')
        ]);

        $superAdminRole = Role::where('name', 'Super Admin')->first();
        if ($superAdminRole) {
            $superAdminRole->givePermissionTo($permission);
        }

        return redirect()->route('permissions.index')->with('success', 'Ruxsat muvaffaqiyatli tahrirlandi');
//        return response()->json([
//            'message' => 'Ruxsat muvaffaqiyatli qo‘shildi!',
//            'redirect' => route('permissions.index')
//        ]);
    }

    public function edit($id)
    {

        $permission = Permission::findById($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,' . $id
        ]);

        $permission = Permission::findById($id);

        $permission->update([
            'name' => $request->name,
            'title' => $request->title
        ]);

        if ($permission) {
            return redirect()->route('permissions.index')->with('success', 'Ruxsat muvaffaqiyatli tahrirlandi');
        } else {
            return redirect()->route('permissions.index')->with('success', 'Ruxsatni  tahrirlashda xatolik yuz berdi');

        }

    }

    public function destroy($id)
    {
        $permission = Permission::findById($id);
        DB::table('model_has_permissions')->where('permission_id', $id)->delete();
        DB::table('role_has_permissions')->where('permission_id', $id)->delete();
        $permission->delete();
        return redirect()->back()->with('success', 'Ruxsat muvaffaqiyatli o`chirildi');
    }

}
