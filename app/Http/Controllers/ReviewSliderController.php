<?php

namespace App\Http\Controllers;

use App\Models\ReviewSlider;
use Illuminate\Http\Request;

class ReviewSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.settings.review-slider.index', [
            'title' => 'Review Slider',
            'subtitle' => '',
            'active' => 'review-slider',
            'datas' => ReviewSlider::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.review-slider.create', [
            'title' => 'Review Slider',
            'subtitle' => 'Add Review Slider',
            'active' => 'review-slider',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'image' => 'required|image|mimes:png,jpg,jpeg',
            ],
            [
                'image.required' => 'Image is required!',
                'image.image' => 'Image must be an image!',
                'image.mimes' => 'Image must be a png, jpg, or jpeg!',
            ]
        );

        $image = $request->file('image');
        $image_name = time() . '.' . $image->extension();
        $image->move(public_path('uploads/review-slider/'), $image_name);

        ReviewSlider::create([
            'image' => $image_name,
        ]);

        return redirect()->route('admin.review-slider')->with('success', 'Review Slider has been added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.settings.review-slider.edit', [
            'title' => 'Review Slider',
            'subtitle' => 'Edit Review Slider',
            'active' => 'review-slider',
            'data' => ReviewSlider::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reviewSlider = ReviewSlider::findOrFail($id);

        if ($request->hasFile('image')) {
            $this->validate($request, 
                [
                    'image' => 'required|image|mimes:png,jpg,jpeg',
                ],
                [
                    'image.required' => 'Image is required!',
                    'image.image' => 'Image must be an image!',
                    'image.mimes' => 'Image must be a png, jpg, or jpeg!',
                ]
            );

            $image = $request->file('image');
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path('uploads/review-slider/'), $image_name);

            $reviewSlider->update([
                'image' => $image_name,
            ]);
        }

        return redirect()->route('admin.review-slider')->with('success', 'Review Slider has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reviewSlider = ReviewSlider::findOrFail($id);

        $image = $reviewSlider->image;

        if ($image) {
            unlink(public_path('uploads/review-slider/' . $image));
        }

        $reviewSlider->delete();

        return redirect()->route('admin.review-slider')->with('success', 'Review Slider has been deleted!');
    }
}
