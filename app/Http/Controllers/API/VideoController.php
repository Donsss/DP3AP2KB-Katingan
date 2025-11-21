<?php

namespace App\Http\Controllers\API;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VideoController extends BaseController
{
    private function getYoutubeId(string $url): ?string
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($pattern, $url, $matches);
        return $matches[1] ?? null;
    }

    private function fetchVideoInfo(string $youtubeId): array
    {
        $defaultTitle = 'Unknown Video Title';
        $thumbnail = "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";

        try {
            $response = Http::get("https://www.youtube.com/watch?v={$youtubeId}");
            if ($response->successful()) {
                $html = $response->body();
                if (preg_match('/<title>(.*?)<\/title>/is', $html, $matches)) {
                    $title = str_replace(' - YouTube', '', $matches[1]);
                    return ['title' => $title, 'thumbnail' => $thumbnail];
                }
            }
        } catch (\Exception $e) {
            Log::error("Failed to fetch YouTube info for ID {$youtubeId}: " . $e->getMessage());
        }

        return ['title' => $defaultTitle, 'thumbnail' => $thumbnail];
    }

    /**
     * @OA\Get(
     * path="/api/videos",
     * tags={"Videos"},
     * summary="Get list of videos",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $videos = Video::latest()->get();
        return $this->sendResponse($videos, 'Data video berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/videos",
     * tags={"Videos"},
     * summary="Create new video",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"youtube_url"},
     * @OA\Property(property="youtube_url", type="string"),
     * @OA\Property(property="title", type="string", description="Optional")
     * )
     * ),
     * @OA\Response(response=200, description="Created successfully")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'youtube_url' => 'required|url',
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $youtubeId = $this->getYoutubeId($request->youtube_url);
        if (!$youtubeId) {
            return $this->sendError('Invalid YouTube URL.');
        }

        $videoInfo = $this->fetchVideoInfo($youtubeId);
        $title = $request->title ?? $videoInfo['title'];

        $video = Video::create([
            'youtube_url' => $request->youtube_url,
            'youtube_id' => $youtubeId,
            'title' => $title,
            'thumbnail' => $videoInfo['thumbnail'],
        ]);

        return $this->sendResponse($video, 'Video berhasil ditambahkan.');
    }

    /**
     * @OA\Get(
     * path="/api/videos/{id}",
     * tags={"Videos"},
     * summary="Get specific video",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function show($id)
    {
        $video = Video::find($id);
        if (is_null($video)) {
            return $this->sendError('Video tidak ditemukan.');
        }
        return $this->sendResponse($video, 'Detail video berhasil diambil.');
    }

    /**
     * @OA\Put(
     * path="/api/videos/{id}",
     * tags={"Videos"},
     * summary="Update video",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"youtube_url"},
     * @OA\Property(property="youtube_url", type="string"),
     * @OA\Property(property="title", type="string")
     * )
     * ),
     * @OA\Response(response=200, description="Updated successfully")
     * )
     */
    public function update(Request $request, Video $video)
    {
        $validator = Validator::make($request->all(), [
            'youtube_url' => 'required|url',
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $youtubeId = $this->getYoutubeId($request->youtube_url);
        if (!$youtubeId) {
            return $this->sendError('Invalid YouTube URL.');
        }

        $videoInfo = $this->fetchVideoInfo($youtubeId);
        $title = $request->title ?? $videoInfo['title'];

        $video->update([
            'youtube_url' => $request->youtube_url,
            'youtube_id' => $youtubeId,
            'title' => $title,
            'thumbnail' => $videoInfo['thumbnail'],
        ]);

        return $this->sendResponse($video, 'Video berhasil diperbarui.');
    }

    /**
     * @OA\Delete(
     * path="/api/videos/{id}",
     * tags={"Videos"},
     * summary="Delete video",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Deleted successfully")
     * )
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return $this->sendResponse([], 'Video berhasil dihapus.');
    }

    /**
     * @OA\Post(
     * path="/api/videos/fetch-info",
     * tags={"Videos"},
     * summary="Fetch YouTube Info (Preview)",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"youtube_url"},
     * @OA\Property(property="youtube_url", type="string")
     * )
     * ),
     * @OA\Response(response=200, description="Info fetched")
     * )
     */
    public function fetchYoutubeInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'youtube_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Invalid URL.', $validator->errors(), 400);
        }

        $youtubeId = $this->getYoutubeId($request->youtube_url);
        if (!$youtubeId) {
            return $this->sendError('Invalid YouTube URL.', [], 400);
        }

        $videoInfo = $this->fetchVideoInfo($youtubeId);

        if ($videoInfo['title'] === 'Unknown Video Title') {
            return $this->sendError('Could not fetch video title.', [], 400);
        }

        return $this->sendResponse([
            'title' => $videoInfo['title'],
            'thumbnail' => $videoInfo['thumbnail'],
            'youtube_id' => $youtubeId,
        ], 'Info video berhasil diambil.');
    }
}