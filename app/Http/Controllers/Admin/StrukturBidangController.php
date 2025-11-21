<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturBidang;
use Illuminate\Http\Request;      
use App\Models\StrukturAnggota;     

class StrukturBidangController extends Controller
{
    public function index()
    {
        $bidangs = StrukturBidang::orderBy('urutan', 'asc')->get();
        return view('admin.struktur-bidang.index', compact('bidangs'));
    }

    public function create()
    {
        return view('admin.struktur-bidang.create');
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'nama_bidang' => 'required|string|max:255',
        ]);

        $validated['is_shifted'] = $request->has('is_shifted');
        $validated['urutan'] = (StrukturBidang::max('urutan') ?? 0) + 1;

        StrukturBidang::create($validated);
        return redirect()->route('admin.struktur-bidang.index')->with('success', 'Section/Bidang baru berhasil ditambahkan.');
    }

    public function edit(StrukturBidang $strukturBidang) 
    {
        return view('admin.struktur-bidang.edit', compact('strukturBidang'));
    }

    public function update(Request $request, StrukturBidang $strukturBidang) 
    {
        $validated = $request->validate([
            'nama_bidang' => 'required|string|max:255',
        ]);
        
        $validated['is_shifted'] = $request->has('is_shifted');

        $strukturBidang->update($validated);
        return redirect()->route('admin.struktur-bidang.index')->with('success', 'Section/Bidang berhasil diperbarui.');
    }

    public function destroy(StrukturBidang $strukturBidang) 
    {
        $strukturBidang->anggota()->delete();
        $strukturBidang->delete();
        
        return redirect()->route('admin.struktur-bidang.index')->with('success', 'Section/Bidang (dan semua anggotanya) berhasil dihapus.');
    }


    public function updateOrder(Request $request) 
    {
        $request->validate(['order' => 'required|array']);

        foreach ($request->order as $index => $id) {
            StrukturBidang::where('id', $id)->update(['urutan' => $index + 1]);
        }

        return response()->json(['message' => 'Urutan section berhasil diperbarui.'], 200);
    }
}