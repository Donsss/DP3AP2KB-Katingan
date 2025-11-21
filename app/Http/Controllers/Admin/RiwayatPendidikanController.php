<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class RiwayatPendidikanController extends Controller
{
    public function index()
    {
        $riwayats = RiwayatPendidikan::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.pendidikan.index', compact('riwayats'));
    }

    public function create()
    {
        return view('admin.pendidikan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'urutan' => 'required|integer',
        ]);

        $newUrutan = (int) $validated['urutan'];

        try {
            DB::transaction(function () use ($newUrutan, $validated) {
                RiwayatPendidikan::where('urutan', '>=', $newUrutan)
                                ->increment('urutan');

                RiwayatPendidikan::create($validated); 
                
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambah data: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('admin.pendidikan.index')
                         ->with('success', 'Riwayat pendidikan berhasil ditambahkan.');
    }

    public function edit(RiwayatPendidikan $riwayatPendidikan)
    {
        return view('admin.pendidikan.edit', compact('riwayatPendidikan'));
    }
    
    public function update(Request $request, RiwayatPendidikan $riwayatPendidikan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'urutan' => 'required|integer',
        ]);

        $newUrutan = (int) $validated['urutan'];
        $oldUrutan = (int) $riwayatPendidikan->urutan;

        if ($newUrutan !== $oldUrutan) {
            
            try {
                DB::transaction(function () use ($riwayatPendidikan, $newUrutan, $oldUrutan, $validated) {
                    
                    $itemKonflik = RiwayatPendidikan::where('urutan', $newUrutan)
                                                   ->where('id', '!=', $riwayatPendidikan->id)
                                                   ->first();

                    if ($itemKonflik) {
                        $itemKonflik->urutan = $oldUrutan;
                        $itemKonflik->save();
                    }

                    $riwayatPendidikan->update($validated);

                });
            } catch (\Exception $e) {
                return back()->with('error', 'Terjadi kesalahan saat menukar urutan: ' . $e->getMessage());
            }

        } else {
            $riwayatPendidikan->update($validated);
        }

        return redirect()->route('admin.pendidikan.index')
                         ->with('success', 'Riwayat pendidikan berhasil diperbarui.');
    }

    public function destroy(RiwayatPendidikan $riwayatPendidikan)
    {
        $urutanItemDihapus = $riwayatPendidikan->urutan;

        try {
            DB::transaction(function () use ($riwayatPendidikan, $urutanItemDihapus) {
                
                $riwayatPendidikan->delete();
                
                RiwayatPendidikan::where('urutan', '>', $urutanItemDihapus)
                                ->decrement('urutan');
            });
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }

        return redirect()->route('admin.pendidikan.index')
                         ->with('success', 'Riwayat pendidikan berhasil dihapus.');
    }
}