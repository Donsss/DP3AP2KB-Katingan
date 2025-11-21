<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::firstOrCreate(['id' => 1]);
        $settings->jam_kerja_input = $settings->jam_kerja ? implode("\n", $settings->jam_kerja) : '';
        $settings->telepon_input = $settings->telepon ? implode("\n", $settings->telepon) : '';

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::find(1);

        $validated = $request->validate([
            'site_name'      => 'nullable|string|max:255',
            'copyright_text' => 'nullable|string|max:255',
            'site_logo'      => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'footer_about'   => 'nullable|string',
            'twitter_url'    => 'nullable|url', 
            'alamat'         => 'nullable|string',
            'jam_kerja_input'=> 'nullable|string',
            'telepon_input'  => 'nullable|string',
            'facebook_url'   => 'nullable|url',
            'instagram_url'  => 'nullable|url',
            'youtube_url'    => 'nullable|url',
            'whatsapp_url'   => 'nullable|url',
            'google_map_url' => 'nullable|string',
            'tiktok_url'     => 'nullable|url',
            'notification_email' => 'nullable|email|max:255',
        ]);

        $jamKerjaArray = $request->jam_kerja_input ? preg_split('/[\r\n]+/', $request->jam_kerja_input, -1, PREG_SPLIT_NO_EMPTY) : [];
        $teleponArray = $request->telepon_input ? preg_split('/[\r\n]+/', $request->telepon_input, -1, PREG_SPLIT_NO_EMPTY) : [];

        $updateData = [
            'site_name'      => $validated['site_name'],
            'copyright_text' => $validated['copyright_text'],
            'footer_about'   => $validated['footer_about'],
            'twitter_url'    => $validated['twitter_url'],
            'alamat'         => $validated['alamat'],
            'jam_kerja'      => $jamKerjaArray,
            'telepon'        => $teleponArray,
            'facebook_url'   => $validated['facebook_url'],
            'instagram_url'  => $validated['instagram_url'],
            'youtube_url'    => $validated['youtube_url'],
            'whatsapp_url'   => $validated['whatsapp_url'],
            'google_map_url' => $validated['google_map_url'],
            'tiktok_url'     => $validated['tiktok_url'],
            'notification_email' => $validated['notification_email'],
        ];

        if ($request->hasFile('site_logo')) {
            if ($settings->site_logo) {
                Storage::disk('public')->delete($settings->site_logo);
            }
            $updateData['site_logo'] = $request->file('site_logo')->store('settings', 'public');
        }

        $settings->update($updateData);

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}