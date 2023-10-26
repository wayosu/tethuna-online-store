<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Information;
use App\Models\MainSlider;
use App\Models\ReviewSlider;
use App\Models\Video;

class FrontPageController extends Controller
{
    public function index()
    {
        return view('front.home', [
            'title' => 'Home',
            'reviewSliders' => ReviewSlider::latest()->get(),
            'aboutUs' => AboutUs::first(),
            'galleries' => Catalog::latest()->take(10)->get(),
            'categories' => Category::orderBy('name', 'ASC')->take(5)->get(),
            'videos' => Video::latest()->take(3)->get(),
            'informations' => Information::latest()->get(),
        ]);
    }

    public function catalog()
    {
        $catalogs = Catalog::latest()->filter(request(['search', 'category_product']))->paginate(16)->withQueryString();

        return view('front.catalog', [
            'title' => 'Catalog',
            'mainSliders' => MainSlider::latest()->get(),
            'categories' => Category::orderBy('name', 'ASC')->get(),
            'products' => $catalogs,
        ]);
    }

    public function productDetail($slug)
    {
        $product = Catalog::where('slug', $slug)->firstorfail();

        $no_hp = AboutUs::pluck('phone')->first(); // Assuming the phone number has '-' characters

        // Remove '-' characters from the phone number
        $no_hp = str_replace('-', '', $no_hp);

        $related_products = Catalog::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id) // Exclude the current product
        ->latest()->take('4')->get();

        return view('front.product-detail', [
            'title' => 'Product | ' . $product->name,
            'mainSliders' => MainSlider::latest()->get(),
            'no_hp' => $no_hp,
            'product' => $product,
            'related_products' => $related_products
        ]);
    }
}
