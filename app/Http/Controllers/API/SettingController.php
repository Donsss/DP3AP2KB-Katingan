<?php

namespace App\Http\Controllers\API;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/settings",
     * tags={"Settings"},
     * summary="Get site settings",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $settings = Setting::firstOrCreate(['id' => 1]);
        return $this->sendResponse($settings, 'Pengaturan berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/settings",
     * tags={"Settings"},
     * summary="Update site settings (Use _method=PUT)",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"_method"},
     * @OA\Property(property="_method", type="string", example="PUT"),
     * @OA\Property(property="site_name", type="string"),
     * @OA\Property(property="copyright_text", type="string"),
     * @OA\Property(property="site_logo", type="string", format="binary"),
     * @OA\Property(property="footer_about", type="string"),
     * @OA\Property(property="alamat", type="string"),
     * @OA\Property(property="jam_kerja[]", type="array", @OA\Items(type="string"), description="Array of strings"),
     * @OA\Property(property="telepon[]", type="array", @OA\Items(type="string"), description="Array of strings"),
     * @OA\Property(property="facebook_url", type="string", format="url"),
     * @OA\Property(property="instagram_url", type="string", format="url"),
     * @OA\Property(property="twitter_url", type="string", format="url"),
     * @OA\Property(property="youtube_url", type="string", format="url"),
     * @OA\Property(property="whatsapp_url", type="string", format="url"),
     * @OA\Property(property="google_map_url", type="string"),
     * @OA\Property(property="tiktok_url", type="string", format="url"),
     * @OA\Property(property="notification_email", type="string", format="email")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Settings updated successfully")
     * )
     */
    public function update(Request $request)
    {
        $settings = Setting::firstOrCreate(['id' => 1]);

        $validator = Validator::make($request->all(), [
            'site_name'      => 'nullable|string|max:255',
            'copyright_text' => 'nullable|string|max:255',
            'site_logo'      => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'footer_about'   => 'nullable|string',
            'twitter_url'    => 'nullable|url',
            'alamat'         => 'nullable|string',
            'jam_kerja'      => 'nullable|array',
            'telepon'        => 'nullable|array',
            'facebook_url'   => 'nullable|url',
            'instagram_url'  => 'nullable|url',
            'youtube_url'    => 'nullable|url',
            'whatsapp_url'   => 'nullable|url',
            'google_map_url' => 'nullable|string',
            'tiktok_url'     => 'nullable|url',
            'notification_email' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $validated = $validator->validated();

        $updateData = [
            'site_name'      => $validated['site_name'] ?? $settings->site_name,
            'copyright_text' => $validated['copyright_text'] ?? $settings->copyright_text,
            'footer_about'   => $validated['footer_about'] ?? $settings->footer_about,
            'twitter_url'    => $validated['twitter_url'] ?? $settings->twitter_url,
            'alamat'         => $validated['alamat'] ?? $settings->alamat,
            'jam_kerja'      => $validated['jam_kerja'] ?? $settings->jam_kerja,
            'telepon'        => $validated['telepon'] ?? $settings->telepon,
            'facebook_url'   => $validated['facebook_url'] ?? $settings->facebook_url,
            'instagram_url'  => $validated['instagram_url'] ?? $settings->instagram_url,
            'youtube_url'    => $validated['youtube_url'] ?? $settings->youtube_url,
            'whatsapp_url'   => $validated['whatsapp_url'] ?? $settings->whatsapp_url,
            'google_map_url' => $validated['google_map_url'] ?? $settings->google_map_url,
            'tiktok_url'     => $validated['tiktok_url'] ?? $settings->tiktok_url,
            'notification_email' => $validated['notification_email'] ?? $settings->notification_email,
        ];

        if ($request->hasFile('site_logo')) {
            if ($settings->site_logo) {
                Storage::disk('public')->delete($settings->site_logo);
            }
            $updateData['site_logo'] = $request->file('site_logo')->store('settings', 'public');
        }

        $settings->update($updateData);

        return $this->sendResponse($settings, 'Pengaturan berhasil diperbarui.');
    }
}