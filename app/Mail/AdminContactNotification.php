<?php
namespace App\Mail;
use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;

class AdminContactNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $contactMessage;
    public $settings;

    /**
     * Buat instance pesan baru.
     *
     * @param ContactMessage $contactMessage
     * @param Setting|null $settings
     */
    // ▼▼ PERBAIKAN 1: Gunakan sintaks PHP 8 ( ?Setting ) ▼▼
    public function __construct(ContactMessage $contactMessage, ?Setting $settings = null)
    {
        $this->contactMessage = $contactMessage;

        // ▼▼ PERBAIKAN 2: Ganti 'first()' dengan 'firstOrCreate()' ▼▼
        // Ini adalah logika "aman" yang kita bahas.
        // "Gunakan $settings, TAPI jika $settings itu null,
        //  ambil 'id'=1, atau BUAT 'id'=1 jika tidak ada."
        // Ini menjamin $this->settings TIDAK AKAN PERNAH null.
        $this->settings = $settings ?? Setting::firstOrCreate(['id' => 1]);
    }
    // ▲▲ AKHIR PERBAIKAN ▲▲

    /**
     * Bangun pesan.
     *
     * @return $this
     */
    public function build()
    {
        // Ambil email PENGIRIM (dari .env MAIL_FROM_ADDRESS)
        $fromAddress = config('mail.from.address', 'hello@example.com');
        $fromName = 'Notifikasi DP3AP2KB Katingan';
        
        return $this->from($fromAddress, $fromName)
                    ->subject('Pesan Formulir Kontak Baru Diterima')
                    ->markdown('emails.contact.admin-notification');
    }
}