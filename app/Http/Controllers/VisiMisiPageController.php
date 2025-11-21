<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiPageController extends Controller {
    
    public function index() {
        $data = VisiMisi::find(1); 
    
        return view('user-views.visi-misi', compact('data'));
    }
}