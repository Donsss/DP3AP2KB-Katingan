<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pimpinan;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;

class ProfilController extends Controller {
    
    public function index() {
        $pimpinan = Pimpinan::find(1);
        $riwayatPendidikan = RiwayatPendidikan::orderBy('urutan', 'desc')->get();
        $riwayatPekerjaan = RiwayatPekerjaan::orderBy('urutan', 'desc')->get();

        return view('user-views.profil-pimpinan', compact(
            'pimpinan', 
            'riwayatPendidikan', 
            'riwayatPekerjaan'
        ));
    }
}