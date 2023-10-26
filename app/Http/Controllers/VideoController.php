<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.video.index', [
            'title' => 'Video',
            'subtitle' => '',
            'active' => 'video',
            'datas' => Video::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.video.create', [
            'title' => 'Video',
            'subtitle' => 'Add Video',
            'active' => 'video',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:videos,title',
            'link_video' => 'required',
        ], [
            'title.required' => 'Title is required!',
            'title.unique' => 'Title is already exists!',
            'link_video.required' => 'Link Video is required!',
        ]);

        Video::create([
            'title' => $request->title,
            'link_video' => $request->link_video,
        ]);

        return redirect()->route('admin.video')->with('success', 'Video has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.video')->with('success', 'Video has been deleted!');
    }
}
