<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller {
    public function edit() {
        $data = VisiMisi::firstOrCreate(['id' => 1]);
        return view('admin.visimisi.edit', compact('data'));
    }

    public function update(Request $request) {
        $data = VisiMisi::find(1);

        $validated = $request->validate([
            'visi' => 'nullable|string',
            'misi_input' => 'nullable|string',
        ]);

        $misiArray = $request->misi_input ? preg_split('/[\r\n]+/', $request->misi_input, -1, PREG_SPLIT_NO_EMPTY) : [];

        $data->update([
            'visi' => $validated['visi'],
            'misi' => $misiArray,
        ]);

        return redirect()->route('admin.visimisi.edit')->with('success', 'Visi & Misi berhasil diperbarui.');
    }
}