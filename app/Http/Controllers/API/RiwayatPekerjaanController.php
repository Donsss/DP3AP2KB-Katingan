<?php

namespace App\Http\Controllers\API;

use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RiwayatPekerjaanController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/pekerjaan",
     * tags={"Riwayat Pekerjaan"},
     * summary="Get list of job history",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $riwayats = RiwayatPekerjaan::orderBy('urutan', 'asc')->paginate(10);
        return $this->sendResponse($riwayats, 'Data riwayat pekerjaan berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/pekerjaan",
     * tags={"Riwayat Pekerjaan"},
     * summary="Create job history",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"judul", "keterangan", "urutan"},
     * @OA\Property(property="judul", type="string"),
     * @OA\Property(property="keterangan", type="string"),
     * @OA\Property(property="urutan", type="integer")
     * )
     * ),
     * @OA\Response(response=200, description="Created successfully")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'urutan' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $validated = $validator->validated();
        $newUrutan = (int) $validated['urutan'];
        $riwayat = null;

        try {
            DB::transaction(function () use ($newUrutan, $validated, &$riwayat) {
                RiwayatPekerjaan::where('urutan', '>=', $newUrutan)
                    ->increment('urutan');

                $riwayat = RiwayatPekerjaan::create($validated);
            });
        } catch (\Exception $e) {
            return $this->sendError('Terjadi kesalahan saat menambah data: ' . $e->getMessage());
        }

        return $this->sendResponse($riwayat, 'Riwayat pekerjaan berhasil ditambahkan.');
    }

    /**
     * @OA\Get(
     * path="/api/pekerjaan/{id}",
     * tags={"Riwayat Pekerjaan"},
     * summary="Get specific job history",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function show($id)
    {
        $riwayat = RiwayatPekerjaan::find($id);
        if (is_null($riwayat)) {
            return $this->sendError('Data tidak ditemukan.');
        }
        return $this->sendResponse($riwayat, 'Data berhasil diambil.');
    }

    /**
     * @OA\Put(
     * path="/api/pekerjaan/{id}",
     * tags={"Riwayat Pekerjaan"},
     * summary="Update job history",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"judul", "keterangan", "urutan"},
     * @OA\Property(property="judul", type="string"),
     * @OA\Property(property="keterangan", type="string"),
     * @OA\Property(property="urutan", type="integer")
     * )
     * ),
     * @OA\Response(response=200, description="Updated successfully")
     * )
     */
    public function update(Request $request, RiwayatPekerjaan $riwayatPekerjaan)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'urutan' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $validated = $validator->validated();
        $newUrutan = (int) $validated['urutan'];
        $oldUrutan = (int) $riwayatPekerjaan->urutan;

        if ($newUrutan !== $oldUrutan) {
            try {
                DB::transaction(function () use ($riwayatPekerjaan, $newUrutan, $oldUrutan, $validated) {
                    $itemKonflik = RiwayatPekerjaan::where('urutan', $newUrutan)
                        ->where('id', '!=', $riwayatPekerjaan->id)
                        ->first();

                    if ($itemKonflik) {
                        $itemKonflik->urutan = $oldUrutan;
                        $itemKonflik->save();
                    }
                    $riwayatPekerjaan->update($validated);
                });
            } catch (\Exception $e) {
                return $this->sendError('Terjadi kesalahan saat menukar urutan: ' . $e->getMessage());
            }
        } else {
            $riwayatPekerjaan->update($validated);
        }

        return $this->sendResponse($riwayatPekerjaan, 'Riwayat pekerjaan berhasil diperbarui.');
    }

    /**
     * @OA\Delete(
     * path="/api/pekerjaan/{id}",
     * tags={"Riwayat Pekerjaan"},
     * summary="Delete job history",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Deleted successfully")
     * )
     */
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
            return $this->sendError('Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
        return $this->sendResponse([], 'Riwayat pekerjaan berhasil dihapus.');
    }
}