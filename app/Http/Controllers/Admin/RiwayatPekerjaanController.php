<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatPekerjaanController extends Controller {
    
    public function index() {
        $riwayats = RiwayatPekerjaan::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.pekerjaan.index', compact('riwayats'));
    }

    public function create() {
        return view('admin.pekerjaan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'urutan' => 'required|integer',
        ]);

        $newUrutan = (int) $validated['urutan'];

        try {
            DB::transaction(function () use ($newUrutan, $validated) {
                RiwayatPekerjaan::where('urutan', '>=', $newUrutan)
                                ->increment('urutan');

                RiwayatPekerjaan::create($validated); 
                
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambah data: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('admin.pekerjaan.index')
                         ->with('success', 'Riwayat pekerjaan berhasil ditambahkan.');
    }

    public function edit(RiwayatPekerjaan $riwayatPekerjaan) {
        return view('admin.pekerjaan.edit', compact('riwayatPekerjaan'));
    }

    public function update(Request $request, RiwayatPekerjaan $riwayatPekerjaan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'urutan' => 'required|integer',
        ]);

        $newUrutan = (int) $validated['urutan'];
        $oldUrutan = (int) $riwayatPekerjaan->urutan;

        if ($newUrutan !== $oldUrutan) {
            
            try {
                DB::transaction(function () use ($riwayatPekerjaan, $newUrutan, $oldUrutan, $validated) {
                    
                    $itemKonflik = RiwayatPekerjaan::where('urutan', $newUrutan)
                                                   ->where('id', '!=', $riwayatPekerjaan->id) // Pastikan bukan item yg sedang kita edit
                                                   ->first();

                    if ($itemKonflik) {
                        $itemKonflik->urutan = $oldUrutan;
                        $itemKonflik->save();
                    }

                    $riwayatPekerjaan->update($validated);

                });
            } catch (\Exception $e) {
                return back()->with('error', 'Terjadi kesalahan saat menukar urutan: ' . $e->getMessage());
            }

        } else {
            $riwayatPekerjaan->update($validated);
        }

        return redirect()->route('admin.pekerjaan.index')
                         ->with('success', 'Riwayat pekerjaan berhasil diperbarui.');
    }

    public function destroy(RiwayatPekerjaan $riwayatPekerjaan)
    {
        $urutanItemDihapus = $riwayatPekerjaan->urutan;

        try {
            DB::transaction(function () use ($riwayatPekerjaan, $urutanItemDihapus) {
                
                $riwayatPekerjaan->delete();
                
                RiwayatPekerjaan::where('urutan', '>', $urutanItemDihapus)
                                ->decrement('urutan');
            });
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }

        return redirect()->route('admin.pekerjaan.index')
                         ->with('success', 'Riwayat pekerjaan berhasil dihapus.');
    }
}