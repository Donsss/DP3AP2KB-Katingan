<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->paginate(10);
        return view('user-views.dokumen', compact('documents'));
    }

    public function show(Document $document)
    {
        $path = storage_path('app/public/' . $document->file_path);

        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File not found.');
        }

        $filename = $document->title . '.' . $document->file_type;

        $headers = [
            'Content-Type' => Storage::disk('public')->mimeType($document->file_path),
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ];
        return response()->file($path, $headers);
    }

    public function download(Document $document)
    {
        $document->increment('download_count');
        return Storage::disk('public')->download($document->file_path, $document->title . '.' . $document->file_type);
    }
}