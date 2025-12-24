<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if_forbidden('user.show');

        $users = User::where('id', '!=', auth()->user()->id)->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if_forbidden('user.add');

//        if (auth()->user()->hasRole('Super Admin'))
//            $roles = Role::all();
//        else

        $roles = Role::where('name', '!=', 'Super Admin')->get();

        return view('admin.users.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if_forbidden('user.add');

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

//        dd($request);

        $user = User::create([
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->get('password')),
        ]);


        $role_cnt = Role::count();

        if ($role_cnt != 0 && $role_cnt < 2) {
            Role::create([
                'name' => 'user',
                'title' => 'User',
                'guard_name' => 'web'
            ]);
        }

        $roleIds = $request->get('roles', []);

        $validRoles = Role::whereIn('id', $roleIds)->pluck('name')->toArray();

        if (empty($validRoles)) {
            $defaultRole = Role::where('name', 'user')->first();

            if ($defaultRole) {
                $user->assignRole($defaultRole->name);
            }
        } else {
            $user->syncRoles($validRoles);
        }


        return redirect()->route('users.index')->with('success', 'Foydalanuvchi muvaffaqiyatli qo`shildi');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
//        $branches = Branch::where('department_id', $id)->get();

//        return response()->json($branches);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $user = auth()->user();

        $isSuperAdmin = $user->hasRole('Super Admin');
        $canEdit = $user->can('user.edit');
        $isSelf = $user->id == $id;

        abort_if(!($isSuperAdmin || $canEdit || $isSelf), 403);

        $user = User::find($id);

        if ($user->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin')) {
            message_set("У вас нет разрешения на редактирование администратора", 'error', 5);
            return redirect()->back();
        }

        $roles = Role::where('name', '!=', 'Super Admin')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user();

        $isSuperAdmin = $user->hasRole('Super Admin');
        $canEdit = $user->can('user.edit');
        $isSelf = $user->id == $id;

        abort_if(!($isSuperAdmin || $canEdit || $isSelf), 403);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', 'unique:users,login,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::find($id);

        $data = [
            'name' => $request->name,
            'login' => $request->input('login'),
            'email' => $request->input('email'),
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        if ($request->filled('roles')) {
            $roleIds = $request->get('roles');
            $roleNames = Role::whereIn('id', $roleIds)->pluck('name')->toArray();

            if (!empty($roleNames)) {
                $user->syncRoles($roleNames);
            } else {
                $defaultRole = Role::where('name', 'user')->first();
                if ($defaultRole) {
                    $user->assignRole($defaultRole->name);
                }
            }
        }


        return redirect()->route('users.index')->with('success', 'Foydalanuvchi muvaffaqiyatli tahrirlandi');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if_forbidden('user.delete');

        $user = User::destroy($id);

        if (auth()->user()->roles[0]->name == "Super Admin") {
            return redirect()->back()->with('error', 'Siz bu foydalanuvchini o`chira olmaysiz');
        }
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        DB::table('model_has_permissions')->where('model_id', $id)->delete();

        return redirect()->route('users.index')->with('success', 'Foydalanuvchi muvaffaqiyatli o`chirildi');
    }
}
