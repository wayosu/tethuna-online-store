<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.information.index', [
            'title' => 'Information',
            'subtitle' => '',
            'active' => 'information',
            'datas' => Information::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.information.create', [
            'title' => 'Information',
            'subtitle' => 'Add Information',
            'active' => 'information',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:information,title',
            'link_image' => 'required',
            'link_information' => 'required',
            'source' => 'required',
        ], [
            'title.required' => 'Title is required!',
            'title.unique' => 'Title is already exists!',
            'link_image.required' => 'Link Image is required!',
            'link_information.required' => 'Link Information is required!',
            'source.required' => 'Source is required!',
        ]);

        Information::create([
            'title' => $request->title,
            'link_image' => $request->link_image,
            'link_information' => $request->link_information,
            'source' => $request->source,
        ]);

        return redirect()->route('admin.information')->with('success', 'Information has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Information $information)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Information $information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Information $information)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $information = Information::findOrFail($id);
        $information->delete();

        return redirect()->route('admin.information')->with('success', 'Information has been deleted!');
    }
}
