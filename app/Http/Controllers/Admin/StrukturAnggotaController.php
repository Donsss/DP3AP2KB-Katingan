<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturAnggota;
use App\Models\StrukturBidang;     
use Illuminate\Http\Request;        
use Illuminate\Support\Facades\Storage;

class StrukturAnggotaController extends Controller
{
    public function index()
    {
        $bidangs = StrukturBidang::with('anggota')
                                  ->orderBy('urutan', 'asc')
                                  ->get();
        return view('admin.struktur-anggota.index', compact('bidangs'));
    }

    public function create()
    {
        $bidangs = StrukturBidang::orderBy('urutan', 'asc')->pluck('nama_bidang', 'id');
        return view('admin.struktur-anggota.create', compact('bidangs'));
    }

    public function store(Request $request) // <-- $request sekarang dikenali
    {
        $validated = $request->validate([
            'struktur_bidang_id' => 'required|exists:struktur_bidangs,id',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        
        $validated['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('struktur_organisasi', 'public');
        }

        $validated['urutan'] = (StrukturAnggota::where('struktur_bidang_id', $validated['struktur_bidang_id'])
                                              ->max('urutan') ?? 0) + 1;

        StrukturAnggota::create($validated);
        return redirect()->route('admin.struktur-anggota.index')->with('success', 'Anggota baru berhasil ditambahkan.');
    }

    public function edit(StrukturAnggota $strukturAnggotum) 
    {
        $anggota = $strukturAnggotum;
        $bidangs = StrukturBidang::orderBy('urutan', 'asc')->pluck('nama_bidang', 'id');
        return view('admin.struktur-anggota.edit', compact('anggota', 'bidangs'));
    }

    public function update(Request $request, StrukturAnggota $strukturAnggotum) 
    {
        $anggota = $strukturAnggotum;
        
        $validated = $request->validate([
            'struktur_bidang_id' => 'required|exists:struktur_bidangs,id',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('foto')) {
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $validated['foto'] = $request->file('foto')->store('struktur_organisasi', 'public');
        }
        
        $anggota->update($validated);
        return redirect()->route('admin.struktur-anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(StrukturAnggota $strukturAnggotum)
    {
        $anggota = $strukturAnggotum;
        
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }
        
        $anggota->delete();
        
        return redirect()->route('admin.struktur-anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
    
    public function updateOrder(Request $request) 
    {
        $request->validate([
            'bidang_id' => 'required|exists:struktur_bidangs,id',
            'order' => 'required|array'
        ]);

        foreach ($request->order as $index => $anggotaId) {
            StrukturAnggota::where('id', $anggotaId)
                          ->where('struktur_bidang_id', $request->bidang_id)
                          ->update(['urutan' => $index + 1]);
        }
        
        return response()->json(['message' => 'Urutan anggota berhasil diperbarui.'], 200);
    }
}