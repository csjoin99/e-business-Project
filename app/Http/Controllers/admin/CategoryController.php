<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\category\CategoryCreateRequest;
use App\Http\Requests\category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->search)) {
            $categories = Category::where('name', 'LIKE', "%{$request->search}%")->paginate(10);
        } else {
            $categories = Category::paginate(10);
        }
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->all();
            Category::create($data);
            return redirect()->route('category.index')->with('success', 'Categoría registrada exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('failure', 'Ocurrio un error, no se pudo registrar la categoría');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $data = $request->all();
            $category->update($data);
            return redirect()->route('category.index')->with('success', 'Categoría actualizada exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('failure', 'Ocurrio un error, no se pudo actualizar la categoría');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Categoría eliminada exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('failure', 'Ocurrio un error, no se pudo eliminar la categoría');
        }
    }
}
