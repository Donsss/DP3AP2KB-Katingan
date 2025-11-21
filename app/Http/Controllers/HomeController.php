<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Post;
use App\Models\Agenda;
use App\Models\Pimpinan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', true)->orderBy('order', 'asc')->get();
        
        $latestPhotos = Photo::latest()->take(4)->get();
        $latestVideos = Video::latest()->take(4)->get();

        $latestPosts = Post::where('status', 'published')
                            ->where('published_at', '<=', now())
                            ->latest('published_at')
                            ->take(4)
                            ->get();

        $popularPosts = Post::where('status', 'published')
                             ->where('published_at', '<=', now())
                             ->orderBy('view_count', 'desc')
                             ->take(5)
                             ->get();
        
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $agendasForMonth = Agenda::whereYear('date', $currentYear)
                                 ->whereMonth('date', $currentMonth)
                                 ->orderBy('time', 'asc')
                                 ->get()
                                 ->groupBy(fn($event) => $event->date->format('Y-m-d'));

        $pimpinan = Pimpinan::find(1);
                                 
        return view('user-views.home', compact(
            'sliders', 'latestPhotos', 'latestVideos', 'latestPosts', 'popularPosts', 'agendasForMonth', 'pimpinan'
        ));
    }
}

