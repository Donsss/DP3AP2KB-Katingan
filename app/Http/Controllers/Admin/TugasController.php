<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function edit()
    {
        $tugas = Tugas::find(1);

        return view('admin.tugas.edit', compact('tugas'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|file|mimes:pdf|max:5028', 
        ]);

        $tugas = Tugas::firstOrNew(['id' => 1]);

        if ($tugas->file_path && Storage::disk('public')->exists($tugas->file_path)) {
            Storage::disk('public')->delete($tugas->file_path);
        }

        $file = $request->file('pdf_file');
        $path = $file->store('dokumen', 'public');
        $originalName = $file->getClientOriginalName();
        $fileSize = $this->formatBytes($file->getSize());

        $tugas->file_path = $path;
        $tugas->file_name = $originalName;
        $tugas->file_size = $fileSize;
        $tugas->save();

        return redirect()->route('admin.tugas.edit')->with('success', 'File Tugas dan Fungsi berhasil diperbarui.');
    }

    private function formatBytes($bytes, $precision = 2) 
    { 
        $units = ['B', 'KB', 'MB', 'GB', 'TB']; 
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
        $bytes /= (1 << (10 * $pow)); 
        return round($bytes, $precision) . ' ' . $units[$pow]; 
    }

    public function destroy()
    {
        $tugas = Tugas::find(1);

        if ($tugas) {
            if ($tugas->file_path && Storage::disk('public')->exists($tugas->file_path)) {
                Storage::disk('public')->delete($tugas->file_path);
            }

            $tugas->file_path = null;
            $tugas->file_name = null;
            $tugas->file_size = null;
            $tugas->save();
        }

        return redirect()->route('admin.tugas.edit')->with('success', 'File Tugas dan Fungsi berhasil dihapus.');
    }
}