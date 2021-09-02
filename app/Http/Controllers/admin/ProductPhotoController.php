<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\product_photo\ProductPhotoCreateRequest;
use App\Http\Requests\product_photo\ProductPhotoEditRequest;
use App\Models\Product;
use App\Models\Product_photo;
use Illuminate\Http\Request;

class ProductPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $product_photos = Product_photo::where('product_id', $product->id)->paginate(10);
        return view('admin.product-photo.index', compact('product', 'product_photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.product-photo.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPhotoCreateRequest $request, Product $product)
    {
        $request->validate([
            'order' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif'
        ]);
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image_name = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('img/product/'), $image_name);
                $url = url('') . '/img/product/' . $image_name;
            }
            $data['image'] = isset($url) ? $url : null;
            $data['product_id'] = $product->id;
            Product_photo::create($data);
            return redirect()->route('product.photo.index', $product)->with('success', 'Foto registrada exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('product.photo.index', $product)->with('failure', 'Ocurrio un error, no se pudo registrar la foto');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_photo  $product_photo
     * @return \Illuminate\Http\Response
     */
    public function show(Product_photo $product_photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_photo  $product_photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_photo $product_photo)
    {
        return view('admin.product-photo.edit', compact('product_photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_photo  $product_photo
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPhotoEditRequest $request, Product_photo $product_photo)
    {
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image_name = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('img/product/'), $image_name);
                $url = url('') . '/img/product/' . $image_name;
            }
            $data['image'] = isset($url) ? $url : $product_photo->image;
            $product_photo->update($data);
            return redirect()->route('product.photo.index', $product_photo->product)->with('success', 'Foto actualizada exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('product.photo.index', $product_photo->product)->with('failure', 'Ocurrio un error, no se pudo actualizar la foto');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_photo  $product_photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_photo $product_photo)
    {
        try {
            $product_photo->delete();
            return redirect()->route('product.photo.index', $product_photo->product)->with('success', 'Foto eliminada exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('product.photo.index', $product_photo->product)->with('failure', 'Ocurrio un error, no se pudo eliminar la foto');
        }
    }
}
