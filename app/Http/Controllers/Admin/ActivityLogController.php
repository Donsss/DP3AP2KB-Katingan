<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->paginate(20);
        return view('admin.activity-log.index', compact('activities'));
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        
        $activity->delete();
        
        return redirect()->back()->with('success', 'Log aktivitas berhasil dihapus.');
    }
}