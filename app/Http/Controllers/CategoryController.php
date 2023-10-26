<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.category.index', [
            'title' => 'Category',
            'subtitle' => '',
            'active' => 'category',
            'datas' => Category::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.category.create', [
            'title' => 'Category',
            'subtitle' => 'Add Category',
            'active' => 'category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'category_name' => 'required|unique:categories,name',
            ],
            [
                'category_name.required' => 'Category name is required!',
                'category_name.unique' => 'Category name is already exists!',
            ]
        );

        Category::create([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
        ]);

        return redirect()->route('admin.category')->with('success', 'Category has been added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.category.edit', [
            'title' => 'Category',
            'subtitle' => 'Edit Category',
            'active' => 'category',
            'data' => Category::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [
                'category_name' => 'required|unique:categories,name,' . $id,
            ],
            [
                'category_name.required' => 'Category name is required!',
                'category_name.unique' => 'Category name is already exists!',
            ]
        );

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
        ]);

        return redirect()->route('admin.category')->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Category has been deleted!');
    }
}
