<?php

namespace App\Http\Controllers\API;

use App\Models\QuickLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuickLinkController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/quick-links",
     * tags={"Quick Links"},
     * summary="Get list of quick links",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $links = QuickLink::orderBy('order', 'asc')->get();
        return $this->sendResponse($links, 'Data tautan berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/quick-links",
     * tags={"Quick Links"},
     * summary="Create new quick link",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"title", "url"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="url", type="string", format="url")
     * )
     * ),
     * @OA\Response(response=200, description="Link created successfully")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'url'   => 'required|url',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $lastOrder = QuickLink::max('order') ?? 0;

        $link = QuickLink::create([
            'title' => $request->title,
            'url'   => $request->url,
            'order' => $lastOrder + 1,
        ]);

        return $this->sendResponse($link, 'Tautan berhasil dibuat.');
    }

    /**
     * @OA\Get(
     * path="/api/quick-links/{id}",
     * tags={"Quick Links"},
     * summary="Get specific quick link",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function show($id)
    {
        $quickLink = QuickLink::find($id);
        if (is_null($quickLink)) {
            return $this->sendError('Tautan tidak ditemukan.');
        }
        return $this->sendResponse($quickLink, 'Tautan berhasil diambil.');
    }

    /**
     * @OA\Put(
     * path="/api/quick-links/{id}",
     * tags={"Quick Links"},
     * summary="Update quick link",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"title", "url"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="url", type="string", format="url")
     * )
     * ),
     * @OA\Response(response=200, description="Link updated successfully")
     * )
     */
    public function update(Request $request, QuickLink $quickLink)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'url'   => 'required|url',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $quickLink->update($request->only('title', 'url'));

        return $this->sendResponse($quickLink, 'Tautan berhasil diperbarui.');
    }

    /**
     * @OA\Delete(
     * path="/api/quick-links/{id}",
     * tags={"Quick Links"},
     * summary="Delete quick link",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Link deleted successfully")
     * )
     */
    public function destroy(QuickLink $quickLink)
    {
        $quickLink->delete();
        return $this->sendResponse([], 'Tautan berhasil dihapus.');
    }

    /**
     * @OA\Post(
     * path="/api/quick-links/reorder",
     * tags={"Quick Links"},
     * summary="Reorder quick links",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"order"},
     * @OA\Property(
     * property="order",
     * type="array",
     * @OA\Items(type="integer", example=1, description="ID of the link")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Order updated successfully")
     * )
     */
    public function updateOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        foreach ($request->order as $index => $id) {
            QuickLink::where('id', $id)->update(['order' => $index + 1]);
        }

        return $this->sendResponse([], 'Urutan berhasil disimpan.');
    }
}