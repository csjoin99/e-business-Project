<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\ProfileRequest;
use App\Http\Requests\user\UserCreateRequest;
use App\Http\Requests\user\UserEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->search)) {
            $users = User::where('id', '!=', auth()->user()->id)
                ->orWhere('name', 'LIKE', "%{$request->search}%")
                ->orWhere('lastname', 'LIKE', "%{$request->search}%")
                ->orWhere('email', 'LIKE', "%{$request->search}%")
                ->paginate(10);
            /* $users = User::withTrashed()->where('id', '!=', auth()->user()->id)
                ->orWhere('name', 'LIKE', "%{$request->search}%")
                ->orWhere('lastname', 'LIKE', "%{$request->search}%")
                ->orWhere('email', 'LIKE', "%{$request->search}%")
                ->paginate(10); */
        } else {
            /* $users = User::where('id', '!=', auth()->user()->id)->withTrashed()->paginate(10); */
            $users = User::where('id', '!=', auth()->user()->id)->paginate(10);
        }
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        try {
            $data = $request->all();
            if ($request->hasFile('avatar')) {
                $image_name = time() . '-' . $request->avatar->getClientOriginalName();
                $request->avatar->move(public_path('img/user/'), $image_name);
                $url = url('') . '/img/user/' . $image_name;
            }
            $data['avatar'] = isset($url) ? $url : null;
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $user->assignRole($data['role']);
            return redirect()->route('user.index')->with('success', 'Usuario registrado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('failure', 'Ocurrio un error, no se pudo registrar al usuario');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        try {
            $data = $request->except('email');
            if ($request->hasFile('avatar')) {
                $image_name = time() . '-' . $request->avatar->getClientOriginalName();
                $request->avatar->move(public_path('img/user/'), $image_name);
                $url = url('') . '/img/user/' . $image_name;
            }
            $data['avatar'] = isset($url) ? $url : $user->avatar;
            $user->update($data);
            $user->removeRole($user->roles->first());
            $user->assignRole($data['role']);
            return redirect()->route('user.index')->with('success', 'Usuario actualizado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('failure', 'Ocurrio un error, no se pudo actualizar los datos del usuario');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Usuario eliminado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('failure', 'Ocurrio un error, no se pudo eliminar al usuario');
        }
    }

    public function restore($user)
    {
        try {
            $user = User::withTrashed()->find($user);
            $user->restore();
            return redirect()->route('user.index')->with('success', 'Usuario restaurado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('failure', 'Ocurrio un error, no se pudo restaurar al usuario');
        }
    }

    public function profile()
    {
        $user = auth()->user();
        return  view('admin.profile.index', compact('user'));
    }

    public function profile_update(ProfileRequest $request)
    {
        try {
            $user = auth()->user();
            $data = $request->only(['name', 'lastname']);
            if ($request->hasFile('avatar')) {
                $image_name = time() . '-' . $request->avatar->getClientOriginalName();
                $request->avatar->move(public_path('img/user/'), $image_name);
                $url = url('') . '/img/user/' . $image_name;
            }
            $data['avatar'] = isset($url) ? $url : $user->avatar;
            if (isset($request->password)) {
                $data['password'] = bcrypt($request->password);
            }
            $user->update($data);
            return redirect()->route('profile')->with('success', 'Perfil actualizado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('profile')->with('failure', 'Ocurrio un error, no se pudo actualizar el perfil');
        }
    }
}
