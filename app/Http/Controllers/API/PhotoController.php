<?php

namespace App\Http\Controllers\API;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PhotoController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/photos",
     * tags={"Photos"},
     * summary="Get list of photos",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $photos = Photo::latest()->get();
        return $this->sendResponse($photos, 'Photos retrieved successfully.');
    }

    /**
     * @OA\Post(
     * path="/api/photos",
     * tags={"Photos"},
     * summary="Upload multiple photos",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"images[]"},
     * @OA\Property(
     * property="images[]",
     * type="array",
     * @OA\Items(type="string", format="binary")
     * )
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Photos uploaded successfully"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images'   => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $createdPhotos = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('photos', 'public');
                $originalName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $title = Str::of($originalName)->replace(['-', '_'], ' ')->title();

                $createdPhotos[] = Photo::create([
                    'image' => $imagePath,
                    'title' => $title,
                ]);
            }
        }

        return $this->sendResponse($createdPhotos, 'Photos uploaded successfully.');
    }

    /**
     * @OA\Get(
     * path="/api/photos/{id}",
     * tags={"Photos"},
     * summary="Get specific photo",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function show($id)
    {
        $photo = Photo::find($id);
        if (is_null($photo)) {
            return $this->sendError('Photo not found.');
        }
        return $this->sendResponse($photo, 'Photo retrieved successfully.');
    }

    /**
     * @OA\Post(
     * path="/api/photos/{id}",
     * tags={"Photos"},
     * summary="Update photo (Use _method=PUT)",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"title", "_method"},
     * @OA\Property(property="_method", type="string", example="PUT"),
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="image", type="string", format="binary", description="Optional new image")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Photo updated successfully")
     * )
     */
    public function update(Request $request, Photo $photo)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $imagePath = $photo->image;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($photo->image);
            $imagePath = $request->file('image')->store('photos', 'public');
        }

        $photo->update([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return $this->sendResponse($photo, 'Photo updated successfully.');
    }

    /**
     * @OA\Delete(
     * path="/api/photos/{id}",
     * tags={"Photos"},
     * summary="Delete photo",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Photo deleted successfully")
     * )
     */
    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->image);
        $photo->delete();
        return $this->sendResponse([], 'Photo deleted successfully.');
    }
}