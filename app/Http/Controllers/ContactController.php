<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\ContactMessage;
use App\Http\Requests\StoreContactRequest;
use App\Mail\AdminContactNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        $settings = Setting::find(1); 
        session(['form_load_time' => time()]);
        
        return view('user-views.kontak', compact('settings'));
    }

    public function store(StoreContactRequest $request)
    {
        $message = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'status' => 'unread',
        ]);

        $settings = Setting::firstOrCreate(['id' => 1]);
        $adminEmail = $settings->notification_email; 

        if ($adminEmail) {
            Mail::to($adminEmail)->queue(new AdminContactNotification($message, $settings));
        } else {
            Log::warning('Formulir kontak diterima, tetapi tidak ada email notifikasi yang diatur di admin panel.');
        }

        return redirect()->route('kontak')->with('success', 'Pesan Anda telah berhasil terkirim!');
    }
}