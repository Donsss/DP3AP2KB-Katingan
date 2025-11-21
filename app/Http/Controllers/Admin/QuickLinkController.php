<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuickLink;
use Illuminate\Http\Request;

class QuickLinkController extends Controller
{
    public function index()
    {
        $links = QuickLink::orderBy('order', 'asc')->get();
        return view('admin.quick-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.quick-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url',
        ]);

        $lastOrder = QuickLink::max('order') ?? 0;

        QuickLink::create([
            'title' => $request->title,
            'url'   => $request->url,
            'order' => $lastOrder + 1,
        ]);

        return redirect()->route('quick-links.index')->with('success', 'Tautan berhasil dibuat.');
    }

    public function edit(QuickLink $quickLink)
    {
        return view('admin.quick-links.edit', compact('quickLink'));
    }

    public function update(Request $request, QuickLink $quickLink)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url',
        ]);

        $quickLink->update($request->only('title', 'url'));

        return redirect()->route('quick-links.index')->with('success', 'Tautan berhasil diperbarui.');
    }

    public function destroy(QuickLink $quickLink)
    {
        $quickLink->delete();
        return redirect()->route('quick-links.index')->with('success', 'Tautan berhasil dihapus.');
    }

    /**
     * FUNGSI BARU UNTUK MENGATUR URUTAN (DRAG & DROP)
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);

        foreach ($request->order as $index => $id) {
            QuickLink::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'success', 'message' => 'Urutan berhasil disimpan.']);
    }
}