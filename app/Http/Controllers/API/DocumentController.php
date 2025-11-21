<?php

namespace App\Http\Controllers\API;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/documents",
     * tags={"Documents"},
     * summary="Get list of documents",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $documents = Document::latest()->paginate(10);
        return $this->sendResponse($documents, 'Documents retrieved successfully.');
    }

    /**
     * @OA\Post(
     * path="/api/documents",
     * tags={"Documents"},
     * summary="Upload new document",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"title", "file"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="file", type="string", format="binary")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Document uploaded successfully"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $file = $request->file('file');
        $filePath = $file->store('documents', 'public');

        $document = Document::create([
            'title' => $request->title,
            'file_path' => $filePath,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize() / 1024,
        ]);

        return $this->sendResponse($document, 'Document uploaded successfully.');
    }

    /**
     * @OA\Get(
     * path="/api/documents/{id}",
     * tags={"Documents"},
     * summary="Get specific document info",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function show($id)
    {
        $document = Document::find($id);
        if (is_null($document)) {
            return $this->sendError('Document not found.');
        }
        return $this->sendResponse($document, 'Document retrieved successfully.');
    }

    /**
     * @OA\Post(
     * path="/api/documents/{id}",
     * tags={"Documents"},
     * summary="Update document (Use _method=PUT)",
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
     * @OA\Property(property="file", type="string", format="binary", description="Optional new file")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Document updated successfully")
     * )
     */
    public function update(Request $request, Document $document)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $filePath = $document->file_path;
        $fileType = $document->file_type;
        $fileSize = $document->file_size;

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($document->file_path);
            $file = $request->file('file');
            $filePath = $file->store('documents', 'public');
            $fileType = $file->getClientOriginalExtension();
            $fileSize = $file->getSize() / 1024;
        }

        $document->update([
            'title' => $request->title,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'file_size' => $fileSize,
        ]);

        return $this->sendResponse($document, 'Document updated successfully.');
    }

    /**
     * @OA\Delete(
     * path="/api/documents/{id}",
     * tags={"Documents"},
     * summary="Delete document",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Document deleted successfully")
     * )
     */
    public function destroy(Document $document)
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return $this->sendResponse([], 'Document deleted successfully.');
    }
}