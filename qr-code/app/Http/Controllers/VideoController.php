<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessVideoUpload;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function showUploadVideo()
    {
        return view('uploadVideo');
    }

    public function uploadVideo(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimetypes:video/mp4',
        ]);

        $data = $request->except('video');

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos', ['disk' => 'my_files']);
            $data['video'] = $path;
        }

        ProcessVideoUpload::dispatch($data);

        return 'done';
    }
}
