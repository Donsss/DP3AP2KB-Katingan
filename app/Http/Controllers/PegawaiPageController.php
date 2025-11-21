<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiPageController extends Controller
{
    public function index()
    {
        $bidangs = Bidang::orderBy('name')->get();
        $pegawais = Pegawai::with('bidang')->inRandomOrder()->get();

        return view('user-views.pegawai', compact('bidangs', 'pegawais'));
    }
}
