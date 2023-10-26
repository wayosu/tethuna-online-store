<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\CatalogImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.catalog.index', [
            'title' => 'Catalog',
            'subtitle' => '',
            'active' => 'catalog',
            'datas' => Catalog::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.catalog.create', [
            'title' => 'Catalog',
            'subtitle' => 'Add Product',
            'active' => 'catalog',
            'categories' => Category::orderBy('name', 'ASC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'name' => 'required|max:255|unique:catalogs,name',
                'category_id' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'other_images.*' => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'name.required' => 'Product name is required!',
                'name.max' => 'Product name is too long!',
                'name.unique' => 'Product name is already exists!',
                'category_id.required' => 'Category is required!',
                'image.required' => 'Image is required!',
                'image.image' => 'Image must be an image!',
                'image.mimes' => 'Image must be a png, jpg, or jpeg!',
                'other_images.*.image' => 'Image must be an image!',
                'other_images.*.mimes' => 'Image must be a png, jpg, or jpeg!',
            ]
        );

        $price = $request->input('price');

        if (!empty($price)) {
            $price = intval(str_replace(',', '', $price)); 
        } else {
            $price = 0;
        }

        $stock = $request->input('stock');

        if (!empty($stock)) {
            $stock = intval(str_replace(',', '', $stock)); 
        } else {
            $stock = 0;
        }

        $slug = Str::slug($request->input('name'));

        $image = $request->file('image');
        $image_name = time() . '-' . rand(1,100) . '-' . $slug . '.' . $image->extension();
        $image->move(public_path('uploads/catalog/image'), $image_name);

        $catalog = Catalog::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'image' => $image_name,
            'price' => $price,
            'stock' => $stock,
            'fabric' => $request->input('fabric'),
        ]);

        if ($request->hasFile('other_images')) {
            $other_images = $request->file('other_images');

            foreach ($other_images as $other_image) {
                $other_image_name = time() . '-' . rand(1,100) . '-' . $slug . '.' . $other_image->extension();
                $other_image->move(public_path('uploads/catalog/other-image/'), $other_image_name);

                $catalog->catalogImages()->create([
                    'catalog_id' => $catalog->id,
                    'image' => $other_image_name,
                ]);
            }
        }

        return redirect()->route('admin.catalog')->with('success', 'Product has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('admin.master-data.catalog.show', [
            'title' => 'Catalog',
            'subtitle' => 'Product Detail',
            'active' => 'catalog',
            'data' => Catalog::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Catalog::findOrFail($id);
        $price = number_format($data->price, 0, ',', ',');

        return view('admin.master-data.catalog.edit', [
            'title' => 'Catalog',
            'subtitle' => 'Edit Product',
            'active' => 'catalog',
            'data' => $data,
            'price' => $price,
            'categories' => Category::orderBy('name', 'ASC')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [
                'name' => 'required|max:255|unique:catalogs,name,' . $id,
                'category_id' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg',
                'other_images.*' => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'name.required' => 'Product name is required!',
                'name.max' => 'Product name is too long!',
                'name.unique' => 'Product name is already exists!',
                'category_id.required' => 'Category is required!',
                'image.image' => 'Image must be an image!',
                'image.mimes' => 'Image must be a png, jpg, or jpeg!',
                'other_images.*.image' => 'Image must be an image!',
                'other_images.*.mimes' => 'Image must be a png, jpg, or jpeg!',
            ]
        );

        $price = $request->input('price');

        if (!empty($price)) {
            $price = intval(str_replace(',', '', $price)); 
        } else {
            $price = 0;
        }

        $stock = $request->input('stock');

        if (!empty($stock)) {
            $stock = intval(str_replace(',', '', $stock)); 
        } else {
            $stock = 0;
        }

        $catalog = Catalog::findOrFail($id);

        $slug = Str::slug($request->input('name'));

        if ($request->hasFile('image')) {
            $current_image = $request->input('current_image');
            $image = $request->file('image');
            $image_name = time() . '-' . rand(1,100) . '-' . $slug . '.' . $image->extension();
            $image->move(public_path('uploads/catalog/image'), $image_name);

            if ($current_image) {
                unlink(public_path('uploads/catalog/image/' . $current_image));
            }

            $catalog->update([
                'name' => $request->input('name'),
                'slug' => $slug,
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
                'image' => $image_name,
                'price' => $price,
                'stock' => $stock,
                'fabric' => $request->input('fabric'),
            ]);
        } else {
            $catalog->update([
                'name' => $request->input('name'),
                'slug' => $slug,
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
                'price' => $price,
                'stock' => $stock,
                'fabric' => $request->input('fabric'),
            ]);
        }

        if ($request->hasFile('other_images')) {
            $other_images = $request->file('other_images');

            foreach ($other_images as $other_image) {
                $other_image_name = time() . '-' . rand(1,100) . '-' . $slug . '.' . $other_image->extension();
                $other_image->move(public_path('uploads/catalog/other-image/'), $other_image_name);

                $catalog->catalogImages()->create([
                    'catalog_id' => $catalog->id,
                    'image' => $other_image_name,
                ]);
            }
        }

        return redirect()->route('admin.catalog')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $catalog = Catalog::findOrFail($id);
        $productImage = $catalog->image;
        $otherImages = $catalog->catalogImages()->get();

        if ($productImage) {
            unlink(public_path('uploads/catalog/image/' . $productImage));
        }

        foreach ($otherImages as $otherImage) {
            unlink(public_path('uploads/catalog/other-image/' . $otherImage->image));
        }

        $catalog->catalogImages()->delete();
        $catalog->delete();

        return redirect()->route('admin.catalog')->with('success', 'Product has been deleted!');
    }

    public function destroyImage($id)
    {
        $image = CatalogImage::findOrFail($id);
        $image_name = $image->image;

        if ($image_name) {
            unlink(public_path('uploads/catalog/other-image/' . $image_name));
        }

        $image->delete();

        return redirect()->back()->with('success', 'Image has been deleted!');
    }

    public function gallery()
    {
        $catalogs = Catalog::latest()->filter(request(['category']))->paginate(12)->withQueryString();

        return view('admin.master-data.gallery.index', [
            'title' => 'Gallery',
            'subtitle' => '',
            'active' => 'gallery',
            'catalogs' => $catalogs,
            'categories' => Category::orderBy('name', 'ASC')->get(),
        ]);
    }
}
