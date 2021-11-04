<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\WebRegisterRequest;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login()
    {
        $settings = Settings::first();
        return view('web.auth.login', compact('settings'));
    }

    public function login_post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $data = $request->only(['email', 'password']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Auth::attempt($data)) {
            return redirect()->route('home');
        } else {
            $validator->errors()->add('email', 'El email o password son incorrectos');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function register()
    {
        $settings = Settings::first();
        return view('web.auth.register', compact('settings'));
    }

    public function register_post(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:100',
                'lastname' => 'required|max:100',
                'email' => 'required|unique:user,email,NULL,id,deleted_at,NULL|max:100',
                'password' => 'required|confirmed|min:1|max:100',
            ], [], [
                'name' => 'nombre',
                'lastname' => 'apellido',
                'email' => 'email',
                'password' => 'password',
            ]);
            $auth_data = $request->only(['email','password']);
            $role = Role::where('name', 'Cliente')->first();
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            User::disableAuditing();
            $user = User::create($data);
            User::enableAuditing();
            $user->assignRole($role->id);
            if (Auth::attempt($auth_data)) {
                return redirect()->route('home');
            } else {
                return redirect()->back();
            }
            return redirect()->route('home');
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
