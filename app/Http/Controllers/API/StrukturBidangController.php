<?php

namespace App\Http\Controllers\API;

use App\Models\StrukturBidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StrukturBidangController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/struktur-bidang",
     * tags={"Struktur Organisasi"},
     * summary="Get list of bidang (sections)",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $bidangs = StrukturBidang::with('anggota')->orderBy('urutan', 'asc')->get();
        return $this->sendResponse($bidangs, 'Data bidang berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/struktur-bidang",
     * tags={"Struktur Organisasi"},
     * summary="Create new bidang",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"nama_bidang"},
     * @OA\Property(property="nama_bidang", type="string"),
     * @OA\Property(property="is_shifted", type="boolean")
     * )
     * ),
     * @OA\Response(response=200, description="Created successfully")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_bidang' => 'required|string|max:255',
            'is_shifted'  => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $validated = $validator->validated();
        $validated['urutan'] = (StrukturBidang::max('urutan') ?? 0) + 1;

        $bidang = StrukturBidang::create($validated);
        return $this->sendResponse($bidang, 'Bidang berhasil ditambahkan.');
    }

    /**
     * @OA\Get(
     * path="/api/struktur-bidang/{id}",
     * tags={"Struktur Organisasi"},
     * summary="Get specific bidang",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function show($id)
    {
        $bidang = StrukturBidang::with('anggota')->find($id);
        if (is_null($bidang)) {
            return $this->sendError('Bidang tidak ditemukan.');
        }
        return $this->sendResponse($bidang, 'Detail bidang berhasil diambil.');
    }

    /**
     * @OA\Put(
     * path="/api/struktur-bidang/{id}",
     * tags={"Struktur Organisasi"},
     * summary="Update bidang",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"nama_bidang"},
     * @OA\Property(property="nama_bidang", type="string"),
     * @OA\Property(property="is_shifted", type="boolean")
     * )
     * ),
     * @OA\Response(response=200, description="Updated successfully")
     * )
     */
    public function update(Request $request, StrukturBidang $strukturBidang)
    {
        $validator = Validator::make($request->all(), [
            'nama_bidang' => 'required|string|max:255',
            'is_shifted'  => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $strukturBidang->update($validator->validated());
        return $this->sendResponse($strukturBidang, 'Bidang berhasil diperbarui.');
    }

    /**
     * @OA\Delete(
     * path="/api/struktur-bidang/{id}",
     * tags={"Struktur Organisasi"},
     * summary="Delete bidang and its members",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Deleted successfully")
     * )
     */
    public function destroy(StrukturBidang $strukturBidang)
    {
        $strukturBidang->anggota()->delete();
        $strukturBidang->delete();
        return $this->sendResponse([], 'Bidang dan anggotanya berhasil dihapus.');
    }

    /**
     * @OA\Post(
     * path="/api/struktur-bidang/reorder",
     * tags={"Struktur Organisasi"},
     * summary="Reorder bidang",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"order"},
     * @OA\Property(property="order", type="array", @OA\Items(type="integer"))
     * )
     * ),
     * @OA\Response(response=200, description="Order updated")
     * )
     */
    public function updateOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order' => 'required|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        foreach ($request->order as $index => $id) {
            StrukturBidang::where('id', $id)->update(['urutan' => $index + 1]);
        }

        return $this->sendResponse([], 'Urutan bidang berhasil diperbarui.');
    }
}