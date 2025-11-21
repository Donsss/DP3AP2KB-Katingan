<?php

//Belum Digunakan

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua bidang beserta relasi pegawainya yang sudah diurutkan
        $bidangs = Bidang::with('pegawais')->get();
        return view('admin.pegawai.index', compact('bidangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bidangs = Bidang::orderBy('name')->get();
        return view('admin.pegawai.create', compact('bidangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bidang_id' => 'required|exists:bidangs,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'status' => 'required|in:asn,non-asn',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = $request->file('photo')->store('pegawai-photos', 'public');
        
        // Atur urutan otomatis ke paling akhir
        $lastOrder = Pegawai::where('bidang_id', $request->bidang_id)->max('order') ?? 0;

        Pegawai::create(array_merge($request->all(), [
            'photo' => $photoPath,
            'order' => $lastOrder + 1,
        ]));

        return redirect()->route('admin.pegawai.index')->with('success', 'Employee added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $bidangs = Bidang::orderBy('name')->get();
        return view('admin.pegawai.edit', compact('pegawai', 'bidangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'bidang_id' => 'required|exists:bidangs,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'status' => 'required|in:asn,non-asn',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = $pegawai->photo;
        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($pegawai->photo);
            $photoPath = $request->file('photo')->store('pegawai-photos', 'public');
        }

        $pegawai->update(array_merge($request->all(), ['photo' => $photoPath]));

        return redirect()->route('admin.pegawai.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        Storage::disk('public')->delete($pegawai->photo);
        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')->with('success', 'Employee deleted successfully.');
    }

    /**
     * Update the display order of employees.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);

        foreach ($request->order as $index => $pegawaiId) {
            Pegawai::where('id', $pegawaiId)->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'success', 'message' => 'Employee order updated.']);
    }
}
