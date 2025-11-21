<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastSeen
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // 1. Ambil timestamp kapan kita terakhir update dari SESSION
            $lastUpdate = session('last_seen_update');

            // 2. Cek: Apakah session-nya kosong ATAU sudah lebih dari 5 menit?
            //    Jika ya, baru kita update database.
            //    Jika tidak (misal baru 2 menit lalu), kita LEWATI.
            if (!$lastUpdate || now()->diffInMinutes($lastUpdate) >= 5) {
                
                // 3. Update database
                $user->last_seen = now();
                $user->timestamps = false; // Jangan sentuh 'updated_at'
                $user->save();

                // 4. Update session
                session(['last_seen_update' => now()]);
            }
        }
        
        return $next($request);
    }
}