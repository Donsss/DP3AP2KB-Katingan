<?php

namespace App\Http\Controllers\API;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TugasController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/tugas",
     * tags={"Tugas"},
     * summary="Get file tugas info",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function edit()
    {
        $tugas = Tugas::find(1);
        if (!$tugas) {
            return $this->sendError('Data tugas belum ada.');
        }
        return $this->sendResponse($tugas, 'Data file tugas diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/tugas",
     * tags={"Tugas"},
     * summary="Update/Upload file tugas (Use _method=PUT)",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"pdf_file", "_method"},
     * @OA\Property(property="_method", type="string", example="PUT"),
     * @OA\Property(property="pdf_file", type="string", format="binary")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="File updated successfully")
     * )
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pdf_file' => 'required|file|mimes:pdf|max:5028',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

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

        return $this->sendResponse($tugas, 'File Tugas dan Fungsi berhasil diperbarui.');
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

    /**
     * @OA\Delete(
     * path="/api/tugas",
     * tags={"Tugas"},
     * summary="Delete file tugas",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="File deleted successfully")
     * )
     */
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

        return $this->sendResponse([], 'File Tugas dan Fungsi berhasil dihapus.');
    }
}