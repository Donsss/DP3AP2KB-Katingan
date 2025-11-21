<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order', 'asc')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('sliders', 'public');

        $lastOrder = Slider::max('order') ?? 0;

        Slider::create([
            'image' => $imagePath,
            'title' => $request->title,
            'status' => $request->has('status'),
            'order' => $lastOrder + 1,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        $imagePath = $slider->image;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image);
            $imagePath = $request->file('image')->store('sliders', 'public');
        }

        $slider->update([
            'image' => $imagePath,
            'title' => $request->title,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();
        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);

        foreach ($request->order as $index => $sliderId) {
            Slider::where('id', $sliderId)->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'success', 'message' => 'Slider order updated successfully.']);
    }
}