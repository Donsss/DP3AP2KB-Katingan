<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeCheck implements ValidationRule
{
    /**
     * Waktu minimal (dalam detik) yang diizinkan untuk submit form.
     */
    protected $minimumTime = 3; // Tetap 3 detik

    /**
     * Jalankan aturan validasi.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 1. Ambil timestamp (sekarang ini integer)
        $loadTime = session('form_load_time');
        
        // 2. Langsung hapus (logika tiket sekali pakai, sudah benar)
        session()->forget('form_load_time');

        // 3. Cek jika tiketnya ada
        if (!$loadTime) {
            $fail('Sesi formulir telah kedaluwarsa. Silakan muat ulang halaman dan coba lagi.');
            return;
        }

        // 4. ▼▼ INI LOGIKA BARUNYA (Matematika Murni) ▼▼
        
        // Ambil waktu saat ini (sebagai integer)
        $submitTime = time();

        // Hitung selisihnya
        $difference = $submitTime - $loadTime;

        // Gagal jika selisihnya kurang dari atau sama dengan 3 detik
        if ($difference <= $this->minimumTime) {
            $fail('Formulir dikirim terlalu cepat. Coba lagi.');
            return;
        }
        
        // ▲▲ AKHIR LOGIKA BARU ▲▲
    }
}