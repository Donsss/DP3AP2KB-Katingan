<?php

namespace App\Http\Controllers\API;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisiMisiController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/visimisi",
     * tags={"Visi Misi"},
     * summary="Get visi misi",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $data = VisiMisi::firstOrCreate(['id' => 1]);
        return $this->sendResponse($data, 'Data Visi Misi berhasil diambil.');
    }

    /**
     * @OA\Put(
     * path="/api/visimisi",
     * tags={"Visi Misi"},
     * summary="Update visi misi",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * @OA\Property(property="visi", type="string"),
     * @OA\Property(property="misi", type="array", @OA\Items(type="string"), description="Array of strings")
     * )
     * ),
     * @OA\Response(response=200, description="Updated successfully")
     * )
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visi' => 'nullable|string',
            'misi' => 'nullable|array', // Client mengirim array JSON
            'misi.*' => 'string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = VisiMisi::find(1);
        $validated = $validator->validated();

        $data->update([
            'visi' => $validated['visi'] ?? $data->visi,
            'misi' => $validated['misi'] ?? $data->misi,
        ]);

        return $this->sendResponse($data, 'Visi & Misi berhasil diperbarui.');
    }
}