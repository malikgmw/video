<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getVideos = Video::where('status', '!=', 0)->get();
        return view('welcome', compact('getVideos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'video' => 'required',
        ]);
        $addVideo = new Video();
        $addVideo->title = $request->title;
        $addVideo->description = $request->description;
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('public/users_videos');
            $getName = explode('/', $path);
            $addVideo->video = $getName[2];
        }
        if(isset($request->options)){
            $addVideo->status = $request->options;
        } else {
            $addVideo->status = 0;
        }
        if ($addVideo->save()) {
            return redirect()->back();
        } else {
            return response()->json([
                'message' => 'Some errorr occurred, Please try again',
                'status_code' => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
