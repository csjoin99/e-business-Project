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
                })
                ->withTrashed()->paginate(10);
        } else {
            $products = Product::withTrashed()->paginate(10);
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
            /* Product::disableAuditing();
            $new_product->code = str_pad($new_product->id, 5, "0", STR_PAD_LEFT);
            $new_product->save();
            Product::enableAuditing(); */
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
            return redirect()->route('product.index')->with('success', 'Producto deshabilitado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('failure', 'Ocurrio un error, no se pudo deshabilitar el producto');
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
                    ->where('temp_stock', '>', 0)
                    ->orWhere('code', 'LIKE', "%{$request->search}%")
                    ->orWhere(function ($subquery)  use ($categories) {
                        $subquery->whereIn('category_id', $categories->pluck('id'));
                    });
            } else {
                $products = $products->where('temp_stock', '>', 0);
            }
            $products = $products->with('category')->get();
            return response()->json([
                'products' => $products,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'products' => [],
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function search_products_buy_order(Request $request)
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
                    ->orWhere('code', 'LIKE', "%{$request->search}%")
                    ->orWhere(function ($subquery)  use ($categories) {
                        $subquery->whereIn('category_id', $categories->pluck('id'));
                    });
            }
            $products = $products->with('category')->get();
            return response()->json([
                'products' => $products,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'products' => [],
                'message' => $th->getMessage()
            ], 400);
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
            ], 400);
        }
    }

    public function restore($product)
    {
        try {
            $product = Product::withTrashed()->find($product);
            Product::disableAuditing();
            $product->restore();
            Product::enableAuditing();
            return redirect()->route('product.index')->with('success', 'Producto restaurado exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('failure', 'Ocurrio un error, no se pudo restaurar el product');
        }
    }
}
