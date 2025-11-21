<?php

namespace App\Http\Controllers;

use App\Models\Post;      
use App\Models\Document;  
use App\Models\StrukturAnggota; 
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{

    public function index()
    {
        $postCount = Post::count();
        $documentCount = Document::count();
        $pegawaiCount = StrukturAnggota::where('is_visible', 1)->count(); 
        $recentActivities = Activity::latest()->take(10)->get();

        return view('dashboard', [
            'postCount' => $postCount,
            'documentCount' => $documentCount,
            'pegawaiCount' => $pegawaiCount, 
            'recentActivities' => $recentActivities,
        ]);
    }
}