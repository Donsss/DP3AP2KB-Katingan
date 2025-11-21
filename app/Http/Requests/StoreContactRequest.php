<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TimeCheck;

class StoreContactRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Izinkan semua orang mengirim form ini
    }

    public function rules()
    {
        return [
            // Aturan User
            'name' => ['required', 'string', 'max:255', new TimeCheck], // <-- Terapkan TimeCheck di sini
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',

            // Lapisan 2: Aturan Honeypot (misal: 'fax')
            'fax' => 'nullable|max:0',
        ];
    }
}