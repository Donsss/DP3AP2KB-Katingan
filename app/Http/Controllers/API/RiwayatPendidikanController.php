<?php

namespace App\Http\Controllers\API;

use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RiwayatPendidikanController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/pendidikan",
     * tags={"Riwayat Pendidikan"},
     * summary="Get list of education history",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $riwayats = RiwayatPendidikan::orderBy('urutan', 'asc')->paginate(10);
        return $this->sendResponse($riwayats, 'Data riwayat pendidikan berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/pendidikan",
     * tags={"Riwayat Pendidikan"},
     * summary="Create education history",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"judul", "keterangan", "deskripsi", "urutan"},
     * @OA\Property(property="judul", type="string"),
     * @OA\Property(property="keterangan", type="string"),
     * @OA\Property(property="deskripsi", type="string"),
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
            'deskripsi' => 'required|string|max:255',
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
                RiwayatPendidikan::where('urutan', '>=', $newUrutan)
                    ->increment('urutan');

                $riwayat = RiwayatPendidikan::create($validated);
            });
        } catch (\Exception $e) {
            return $this->sendError('Terjadi kesalahan saat menambah data: ' . $e->getMessage());
        }

        return $this->sendResponse($riwayat, 'Riwayat pendidikan berhasil ditambahkan.');
    }

    /**
     * @OA\Get(
     * path="/api/pendidikan/{id}",
     * tags={"Riwayat Pendidikan"},
     * summary="Get specific education history",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function show($id)
    {
        $riwayat = RiwayatPendidikan::find($id);
        if (is_null($riwayat)) {
            return $this->sendError('Data tidak ditemukan.');
        }
        return $this->sendResponse($riwayat, 'Data berhasil diambil.');
    }

    /**
     * @OA\Put(
     * path="/api/pendidikan/{id}",
     * tags={"Riwayat Pendidikan"},
     * summary="Update education history",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"judul", "keterangan", "deskripsi", "urutan"},
     * @OA\Property(property="judul", type="string"),
     * @OA\Property(property="keterangan", type="string"),
     * @OA\Property(property="deskripsi", type="string"),
     * @OA\Property(property="urutan", type="integer")
     * )
     * ),
     * @OA\Response(response=200, description="Updated successfully")
     * )
     */
    public function update(Request $request, RiwayatPendidikan $riwayatPendidikan)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'urutan' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $validated = $validator->validated();
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
                return $this->sendError('Terjadi kesalahan saat menukar urutan: ' . $e->getMessage());
            }
        } else {
            $riwayatPendidikan->update($validated);
        }

        return $this->sendResponse($riwayatPendidikan, 'Riwayat pendidikan berhasil diperbarui.');
    }

    /**
     * @OA\Delete(
     * path="/api/pendidikan/{id}",
     * tags={"Riwayat Pendidikan"},
     * summary="Delete education history",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Deleted successfully")
     * )
     */
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
            return $this->sendError('Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
        return $this->sendResponse([], 'Riwayat pendidikan berhasil dihapus.');
    }
}