<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasFungsiController extends Controller
{
    public function show()
    {
        $tugas = Tugas::find(1);
        
        if (!$tugas || !$tugas->file_path || !Storage::disk('public')->exists($tugas->file_path)) {
            
            $tugas = null; 
        }

        return view('user-views.tugas', compact('tugas'));
    }
}