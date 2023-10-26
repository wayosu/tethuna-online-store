<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.settings.about-us.index', [
            'title' => 'About Us',
            'subtitle' => '',
            'active' => 'about-us',
            'data' => AboutUs::first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = AboutUs::findOrFail($id);

        $data->update([
            'desc' => $request->desc,
            'phone' => $request->phone,
            'email' => $request->email,
            'maps' => $request->maps,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
        ]);

        return redirect()->route('admin.about-us')->with('success', 'Data has been updated!');
    }
}
