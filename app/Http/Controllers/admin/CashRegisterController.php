<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CashRegisterController extends Controller
{
    public function cash_register()
    {
        $customers = User::where('id', '!=', auth()->user()->id)->orderBy('name')->get();
        return view('admin.cash-register.create', compact('customers'));
    }
}
