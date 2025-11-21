<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http; // Pastikan ini tetap ada untuk request HTTP
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    // Helper untuk mengekstrak ID YouTube
    private function getYoutubeId(string $url): ?string
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($pattern, $url, $matches);
        return $matches[1] ?? null;
    }

    // Helper yang diperbaiki untuk mendapatkan info video tanpa YouTube API Tool
    private function fetchVideoInfo(string $youtubeId): array
    {
        $defaultTitle = 'Unknown Video Title';
        $thumbnail = "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg"; // Default HQ thumbnail

        try {
            // Coba ambil judul dari halaman HTML YouTube
            $response = Http::get("https://www.youtube.com/watch?v={$youtubeId}");
            
            if ($response->successful()) {
                $html = $response->body();
                // Ekstrak judul menggunakan regex atau DOM parsing sederhana
                if (preg_match('/<title>(.*?)<\/title>/is', $html, $matches)) {
                    // Judul dari YouTube akan selalu memiliki " - YouTube" di akhirnya
                    $title = str_replace(' - YouTube', '', $matches[1]);
                    return [
                        'title' => $title,
                        'thumbnail' => $thumbnail,
                    ];
                }
            }
        } catch (\Exception $e) {
            // Jika gagal karena masalah koneksi atau lainnya
            Log::error("Failed to fetch YouTube info for ID {$youtubeId} via HTTP: " . $e->getMessage());
        }

        // Fallback jika tidak bisa mendapatkan dari HTML atau ada error
        return [
            'title' => $defaultTitle,
            'thumbnail' => $thumbnail,
        ];
    }

    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'youtube_url' => 'required|url',
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $youtubeId = $this->getYoutubeId($request->youtube_url);

        if (!$youtubeId) {
            return redirect()->back()->withErrors(['youtube_url' => 'Invalid YouTube URL provided.'])->withInput();
        }

        // Ambil info video (judul & thumbnail)
        $videoInfo = $this->fetchVideoInfo($youtubeId);

        // Jika user tidak memberikan judul, gunakan judul dari YouTube
        $title = $request->title ?? $videoInfo['title'];

        Video::create([
            'youtube_url' => $request->youtube_url,
            'youtube_id' => $youtubeId,
            'title' => $title,
            'thumbnail' => $videoInfo['thumbnail'],
        ]);

        return redirect()->route('videos.index')->with('success', 'Video added successfully.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $validator = Validator::make($request->all(), [
            'youtube_url' => 'required|url',
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $youtubeId = $this->getYoutubeId($request->youtube_url);

        if (!$youtubeId) {
            return redirect()->back()->withErrors(['youtube_url' => 'Invalid YouTube URL provided.'])->withInput();
        }

        // Ambil info video (judul & thumbnail) untuk URL baru atau yang sama
        $videoInfo = $this->fetchVideoInfo($youtubeId);

        // Jika user tidak memberikan judul, gunakan judul dari YouTube
        $title = $request->title ?? $videoInfo['title'];

        $video->update([
            'youtube_url' => $request->youtube_url,
            'youtube_id' => $youtubeId,
            'title' => $title,
            'thumbnail' => $videoInfo['thumbnail'],
        ]);

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
    }

    // Metode AJAX untuk fetching info YouTube secara real-time di form
    public function fetchYoutubeInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'youtube_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid URL provided.'], 400);
        }

        $youtubeId = $this->getYoutubeId($request->youtube_url);

        if (!$youtubeId) {
            return response()->json(['error' => 'Invalid YouTube URL.'], 400);
        }

        $videoInfo = $this->fetchVideoInfo($youtubeId);
        
        // Periksa apakah title bukan 'Unknown Video Title', jika itu fallback
        if ($videoInfo['title'] === 'Unknown Video Title') {
             return response()->json(['error' => 'Could not fetch video title from YouTube. Please check the URL or enter a title manually.'], 400);
        }

        return response()->json([
            'title' => $videoInfo['title'],
            'thumbnail' => $videoInfo['thumbnail'],
            'youtube_id' => $youtubeId,
        ]);
    }
}
