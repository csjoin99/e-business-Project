<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\ProductCreateRequest;
use App\Http\Requests\product\ProductEditRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->search)) {
            $categories = Category::where('name', 'LIKE', "%{$request->search}%")->get();
            $products = Product::where('name', 'LIKE', "%{$request->search}%")
                ->orWhere('code', 'LIKE', "%{$request->search}%")
                ->orWhere(function ($subquery)  use ($categories) {
                    $subquery->whereIn('category_id', $categories->pluck('id'));
                })->paginate(10);
        } else {
            $products = Product::paginate(10);
        }
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        try {
            $data = $request->all();
            $new_product = Product::create($data);
            $new_product->code = str_pad($new_product->id, 5, "0", STR_PAD_LEFT);
            $new_product->save();
            return redirect()->route('product.index')->with('success', 'Producto registrado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('failure', 'Ocurrio un error, no se pudo registrar el producto');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductEditRequest $request, Product $product)
    {
        try {
            $data = $request->all();
            $product->update($data);
            return redirect()->route('product.index')->with('success', 'Producto actualizado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('failure', 'Ocurrio un error, no se pudo actualizar el producto');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Producto eliminado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('failure', 'Ocurrio un error, no se pudo eliminar el producto');
        }
    }

    public function search_products(Request $request)
    {
        try {
            $product_list = $request->product_list ? array_column($request->product_list, 'id') : [];
            $products = Product::where(function ($query) use ($product_list) {
                foreach ($product_list as $item) {
                    $query->where('id', '!=', $item);
                }
            });
            if ($request->search !== null) {
                $categories = Category::where('name', 'LIKE', "%{$request->search}%")->get();
                $products = $products->where('name', 'LIKE', "%{$request->search}%")
                    ->where('stock', '>', 0)
                    ->orWhere('code', 'LIKE', "%{$request->search}%")
                    ->orWhere(function ($subquery)  use ($categories) {
                        $subquery->whereIn('category_id', $categories->pluck('id'));
                    });
            } else {
                $products = $products->where('stock', '>', 0);
            }
            $products = $products->with('category')->get();
            return response()->json([
                'products' => $products,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'products' => [],
                'message' => $th->getMessage()
            ], 200);
        }
    }

    public function find_product_by_id(Request $request)
    {
        try {
            $product = Product::find($request->id);
            return response()->json([
                'product' => $product,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'No hay producto con ese id'
            ], 200);
        }
    }
}
