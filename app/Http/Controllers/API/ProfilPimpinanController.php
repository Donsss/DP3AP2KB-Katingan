<?php

namespace App\Http\Controllers\API;

use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfilPimpinanController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/pimpinan",
     * tags={"Profil Pimpinan"},
     * summary="Get profil pimpinan",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $pimpinan = Pimpinan::firstOrCreate(
            ['id' => 1],
            ['name' => 'Masukkan Nama Pimpinan']
        );
        return $this->sendResponse($pimpinan, 'Data pimpinan berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/pimpinan",
     * tags={"Profil Pimpinan"},
     * summary="Update profil pimpinan (Use _method=PUT)",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"name", "_method"},
     * @OA\Property(property="_method", type="string", example="PUT"),
     * @OA\Property(property="name", type="string"),
     * @OA\Property(property="photo", type="string", format="binary"),
     * @OA\Property(property="nip", type="string"),
     * @OA\Property(property="pangkat_golongan", type="string"),
     * @OA\Property(property="tempat_lahir", type="string"),
     * @OA\Property(property="tanggal_lahir", type="string", format="date"),
     * @OA\Property(property="jabatan", type="string"),
     * @OA\Property(property="quote", type="string"),
     * @OA\Property(property="alamat", type="string"),
     * @OA\Property(property="agama", type="string")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Profil updated successfully")
     * )
     */
    public function update(Request $request)
    {
        $pimpinan = Pimpinan::firstOrCreate(['id' => 1]);

        $validator = Validator::make($request->all(), [
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
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $validatedData = $validator->validated();

        if ($request->hasFile('photo')) {
            if ($pimpinan->photo) {
                Storage::disk('public')->delete($pimpinan->photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('pimpinan', 'public');
        }

        $pimpinan->update($validatedData);

        return $this->sendResponse($pimpinan, 'Profil Pimpinan berhasil diperbarui.');
    }
}