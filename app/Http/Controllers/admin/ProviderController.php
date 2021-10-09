<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\provider\ProviderCreateRequest;
use App\Http\Requests\provider\ProviderEditRequest;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::paginate(10);
        return view('admin.provider.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.provider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderCreateRequest $request)
    {
        try {
            $data = $request->all();
            $provider = Provider::create($data);
            $provider->save();
            return redirect()->route('provider.index')->with('success', 'Proveedor registrado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('provider.index')->with('failure', 'Ocurrio un error, no se pudo registrar el proveedor');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        return view('admin.provider.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderEditRequest $request, Provider $provider)
    {
        try {
            $data = $request->all();
            $provider->update($data);
            return redirect()->route('provider.index')->with('success', 'Proveedor actualizado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('provider.index')->with('failure', 'Ocurrio un error, no se pudo actualizar al proveedor');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        try {
            $provider->delete();
            return redirect()->route('provider.index')->with('success', 'Proveedor eliminado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('provider.index')->with('failure', 'Ocurrio un error, no se pudo eliminar al proveedor');
        }
    }
}
