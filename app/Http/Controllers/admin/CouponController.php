<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\coupon\CouponCreateRequest;
use App\Http\Requests\coupon\CouponEditRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponCreateRequest $request)
    {
        try {
            $fun = function ($value) {
                $date = trim($value);
                $time = strtotime($date);
                return date('Y-m-d', $time);
            };
            $dates = array_map($fun, explode('-', $request->date));
            $data = $request->all();
            $data['date_start'] = $dates[0];
            $data['date_end'] = $dates[1];
            dd($data);
            Coupon::create($data);
            return redirect()->route('coupon.index')->with('success', 'Cupón registrado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('coupon.index')->with('failure', 'Ocurrio un error, no se pudo registrar el cupón');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(CouponEditRequest $request, Coupon $coupon)
    {
        try {
            $fun = function ($value) {
                $date = trim($value);
                $time = strtotime($date);
                return date('Y-m-d', $time);
            };
            $dates = array_map($fun, explode('-', $request->date));
            $data = $request->all();
            $data['date_start'] = $dates[0];
            $data['date_end'] = $dates[1];
            $coupon->update($data);
            return redirect()->route('coupon.index')->with('success', 'Cupón actualizado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('coupon.index')->with('failure', 'Ocurrio un error, no se pudo actualizar el cupón');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
            return redirect()->route('coupon.index')->with('success', 'Cupón eliminado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('coupon.index')->with('failure', 'Ocurrio un error, no se pudo eliminar el cupón');
        }
    }

    public function get_coupon(Request  $request)
    {
        try {
            $coupon = Coupon::where('code', $request->code)->first();
            if (!$coupon || $coupon->status !== "Activo")
                return response()->json([
                    'error' => 'No hay cupón con ese código',
                ], 400);
            return response()->json([
                'coupon' => $coupon,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Ocurrio un error',
            ], 400);
        }
    }
}
