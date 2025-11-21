<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Video;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function photos()
    {
        $photos = Photo::latest()->paginate(20);
        return view('user-views.foto', compact('photos'));
    }

    public function videos()
    {
        $videos = Video::latest()->paginate(20);  
        return view('user-views.video', compact('videos'));
    }
}