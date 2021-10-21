<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use Illuminate\Http\Request;


class AuditController extends Controller
{
    public function index()
    {
        $audit_list = Audit::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.audit.index', compact('audit_list'));
    }

    public function show(Audit $audit)
    {
        return view('admin.audit.show', compact('audit'));
    }
}
