<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        $settings = Settings::first();
        return view('admin.auth.login', compact('settings'));
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
            return redirect()->back();
        } else {
            $validator->errors()->add('email', 'El email o password son incorrectos');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
