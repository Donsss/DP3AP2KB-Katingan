<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilPimpinanController extends Controller {
    public function edit() {
        $pimpinan = Pimpinan::firstOrCreate(
            ['id' => 1],
            ['name' => 'Masukkan Nama Pimpinan']
        );
        return view('admin.pimpinan.edit', compact('pimpinan'));
    }

    public function update(Request $request) {
        $pimpinan = Pimpinan::find(1);

        $rules = [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'nip' => 'nullable|string|max:100',
            'pangkat_golongan' => 'nullable|string|max:100',
            'tempat_lahir' => 'nullable|string|max:100',
            'jabatan' => 'nullable|string|max:255',
            'quote' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'agama' => 'nullable|string|max:50',
        ];

        $validatedData = $request->validate($rules);

        if ($request->hasFile('photo')) {
            if ($pimpinan->photo) {
                Storage::disk('public')->delete($pimpinan->photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('pimpinan', 'public');
        }

        $pimpinan->update($validatedData);

        return redirect()->route('admin.pimpinan.edit')->with('success', 'Profil Pimpinan berhasil diperbarui.');
    }
}