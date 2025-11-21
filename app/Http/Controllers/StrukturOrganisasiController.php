<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StrukturBidang;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller {
    
    public function index() {
        $bidangs = StrukturBidang::with('anggota')
                                  ->orderBy('urutan', 'asc')
                                  ->get();
                                  
        return view('user-views.struktur-organisasi', compact('bidangs'));
    }
}