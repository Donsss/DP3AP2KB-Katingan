<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('admin.photos.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.photos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images'   => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        if ($request->hasFile('images')) {
            
            foreach ($request->file('images') as $imageFile) {
                
                $imagePath = $imageFile->store('photos', 'public');
                
                $originalName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $title = Str::of($originalName)->replace(['-', '_'], ' ')->title();

                Photo::create([
                    'image' => $imagePath, 
                    'title' => $title,
                ]);
            }
        }

        return redirect()->route('photos.index')->with('success', 'Foto-foto berhasil diunggah.');
    }

    public function edit(Photo $photo)
    {
        return view('admin.photos.edit', compact('photo'));
    }

    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $photo->image;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($photo->image);
            $imagePath = $request->file('image')->store('photos', 'public');
        }

        $photo->update([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return redirect()->route('photos.index')->with('success', 'Photo updated successfully.');
    }

    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->image);
        $photo->delete();
        return redirect()->route('photos.index')->with('success', 'Photo deleted successfully.');
    }
}
