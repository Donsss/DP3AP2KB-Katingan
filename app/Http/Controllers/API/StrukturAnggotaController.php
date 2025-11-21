<?php

namespace App\Http\Controllers\API;

use App\Models\StrukturAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StrukturAnggotaController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/struktur-anggota",
     * tags={"Struktur Anggota"},
     * summary="Get list of anggota",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $anggota = StrukturAnggota::with('bidang')->orderBy('urutan', 'asc')->get();
        return $this->sendResponse($anggota, 'Data anggota berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/struktur-anggota",
     * tags={"Struktur Anggota"},
     * summary="Create new anggota",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"struktur_bidang_id", "nama", "jabatan"},
     * @OA\Property(property="struktur_bidang_id", type="integer"),
     * @OA\Property(property="nama", type="string"),
     * @OA\Property(property="jabatan", type="string"),
     * @OA\Property(property="nip", type="string"),
     * @OA\Property(property="foto", type="string", format="binary"),
     * @OA\Property(property="is_visible", type="boolean")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Created successfully")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'struktur_bidang_id' => 'required|exists:struktur_bidangs,id',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_visible' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $validated = $validator->validated();
        $validated['is_visible'] = $request->boolean('is_visible');

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('struktur_organisasi', 'public');
        }

        $validated['urutan'] = (StrukturAnggota::where('struktur_bidang_id', $validated['struktur_bidang_id'])
            ->max('urutan') ?? 0) + 1;

        $anggota = StrukturAnggota::create($validated);
        return $this->sendResponse($anggota, 'Anggota berhasil ditambahkan.');
    }

    /**
     * @OA\Get(
     * path="/api/struktur-anggota/{id}",
     * tags={"Struktur Anggota"},
     * summary="Get specific anggota",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function show($id)
    {
        $anggota = StrukturAnggota::with('bidang')->find($id);
        if (is_null($anggota)) {
            return $this->sendError('Anggota tidak ditemukan.');
        }
        return $this->sendResponse($anggota, 'Detail anggota berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/struktur-anggota/{id}",
     * tags={"Struktur Anggota"},
     * summary="Update anggota (Use _method=PUT)",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"struktur_bidang_id", "nama", "jabatan", "_method"},
     * @OA\Property(property="_method", type="string", example="PUT"),
     * @OA\Property(property="struktur_bidang_id", type="integer"),
     * @OA\Property(property="nama", type="string"),
     * @OA\Property(property="jabatan", type="string"),
     * @OA\Property(property="nip", type="string"),
     * @OA\Property(property="foto", type="string", format="binary"),
     * @OA\Property(property="is_visible", type="boolean")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Updated successfully")
     * )
     */
    public function update(Request $request, StrukturAnggota $strukturAnggotum)
    {
        $validator = Validator::make($request->all(), [
            'struktur_bidang_id' => 'required|exists:struktur_bidangs,id',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_visible' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $validated = $validator->validated();
        $validated['is_visible'] = $request->boolean('is_visible');

        if ($request->hasFile('foto')) {
            if ($strukturAnggotum->foto) {
                Storage::disk('public')->delete($strukturAnggotum->foto);
            }
            $validated['foto'] = $request->file('foto')->store('struktur_organisasi', 'public');
        }

        $strukturAnggotum->update($validated);
        return $this->sendResponse($strukturAnggotum, 'Data anggota berhasil diperbarui.');
    }

    /**
     * @OA\Delete(
     * path="/api/struktur-anggota/{id}",
     * tags={"Struktur Anggota"},
     * summary="Delete anggota",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Deleted successfully")
     * )
     */
    public function destroy(StrukturAnggota $strukturAnggotum)
    {
        if ($strukturAnggotum->foto) {
            Storage::disk('public')->delete($strukturAnggotum->foto);
        }
        $strukturAnggotum->delete();
        return $this->sendResponse([], 'Anggota berhasil dihapus.');
    }

    /**
     * @OA\Post(
     * path="/api/struktur-anggota/reorder",
     * tags={"Struktur Anggota"},
     * summary="Reorder anggota within bidang",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"bidang_id", "order"},
     * @OA\Property(property="bidang_id", type="integer"),
     * @OA\Property(property="order", type="array", @OA\Items(type="integer"))
     * )
     * ),
     * @OA\Response(response=200, description="Order updated")
     * )
     */
    public function updateOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bidang_id' => 'required|exists:struktur_bidangs,id',
            'order' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        foreach ($request->order as $index => $anggotaId) {
            StrukturAnggota::where('id', $anggotaId)
                ->where('struktur_bidang_id', $request->bidang_id)
                ->update(['urutan' => $index + 1]);
        }

        return $this->sendResponse([], 'Urutan anggota berhasil diperbarui.');
    }
}