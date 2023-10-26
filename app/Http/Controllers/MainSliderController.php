<?php

namespace App\Http\Controllers;

use App\Models\MainSlider;
use Illuminate\Http\Request;

class MainSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.settings.main-slider.index', [
            'title' => 'Main Slider',
            'subtitle' => '',
            'active' => 'main-slider',
            'datas' => MainSlider::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.main-slider.create', [
            'title' => 'Main Slider',
            'subtitle' => 'Add Main Slider',
            'active' => 'main-slider',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'title' => 'required|max:255',
                'sub_title' => 'max:255',
                'image' => 'required|image|mimes:png,jpg,jpeg',
            ],
            [
                'title.required' => 'Title is required!',
                'title.max' => 'Title is too long!',
                'sub_title.max' => 'Sub Title is too long!',
                'image.required' => 'Image is required!',
                'image.image' => 'Image must be an image!',
                'image.mimes' => 'Image must be a png, jpg, or jpeg!',
            ]
        );

        $image = $request->file('image');
        $image_name = time() . '.' . $image->extension();
        $image->move(public_path('uploads/main-slider/'), $image_name);

        MainSlider::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'image' => $image_name,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.main-slider')->with('success', 'Main Slider has been added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $mainSlider = MainSlider::findOrFail($id);

        return view('admin.settings.main-slider.edit', [
            'title' => 'Main Slider',
            'subtitle' => 'Edit Main Slider',
            'active' => 'main-slider',
            'data' => $mainSlider,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [
                'title' => 'required|max:255',
                'sub_title' => 'max:255',
                'image' => 'image|mimes:png,jpg,jpeg',
            ],
            [
                'title.required' => 'Title is required!',
                'title.max' => 'Title is too long!',
                'sub_title.max' => 'Sub Title is too long!',
                'image.image' => 'Image must be an image!',
                'image.mimes' => 'Image must be a png, jpg, or jpeg!',
            ]
        );

        $mainSlider = MainSlider::findOrFail($id);

        $image = $mainSlider->image;

        if ($request->file('image')) {
            if ($image) {
                unlink(public_path('uploads/main-slider/' . $image));
            }

            $image = $request->file('image');
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path('uploads/main-slider/'), $image_name);
        }

        $mainSlider->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'image' => $image_name,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.main-slider')->with('success', 'Main Slider has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mainSlider = MainSlider::findOrFail($id);

        $image = $mainSlider->image;

        if ($image) {
            unlink(public_path('uploads/main-slider/' . $image));
        }

        $mainSlider->delete();

        return redirect()->route('admin.main-slider')->with('success', 'Main Slider has been deleted!');
    }
}
