<?php

//Belum Digunakan

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidangs = Bidang::withCount('pegawais')->latest()->paginate(10);
        return view('admin.bidang.index', compact('bidangs'));
    }

    /**
     * Show the form for creating a new resource.
     * NOTE: This is optional if you use the combined index/create page.
     */
    public function create()
    {
        return view('admin.bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:bidangs,name|max:255',
        ]);

        Bidang::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('bidang.index')->with('success', 'Bidang created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bidang $bidang)
    {
        return view('admin.bidang.edit', compact('bidang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bidang $bidang)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:bidangs,name,' . $bidang->id,
        ]);

        $bidang->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('bidang.index')->with('success', 'Bidang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bidang $bidang)
    {
        if ($bidang->pegawais()->count() > 0) {
            return redirect()->route('bidang.index')->with('error', 'Cannot delete bidang because it has associated employees.');
        }

        $bidang->delete();

        return redirect()->route('bidang.index')->with('success', 'Bidang deleted successfully.');
    }
}
