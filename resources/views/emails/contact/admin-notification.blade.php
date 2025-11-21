@component('mail::message')
{{-- 
    ======================================
    HEADER KUSTOM (MENGGANTI LOGO LARAVEL)
    ======================================
    Kita override slot 'header' default
--}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{-- Tampilkan logo kustom Anda --}}
        @if($settings && $settings->site_logo)
            <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" style="max-height: 75px; width: auto;">
        @else
            {{-- Fallback jika tidak ada logo --}}
            {{ $settings->site_name ?? config('app.name') }}
        @endif
    @endcomponent
@endslot

{{-- 
    ======================================
    ISI PESAN (SAMA SEPERTI SEBELUMNYA)
    ======================================
--}}
# Pesan Kontak Baru Diterima

Anda baru saja menerima pesan baru dari formulir kontak website.

**Pengirim:** {{ $contactMessage->name }}
**Email:** [{{ $contactMessage->email }}](mailto:{{ $contactMessage->email }})
**Subjek:** {{ $contactMessage->subject ?? '-' }}
**IP Address:** {{ $contactMessage->ip_address ?? 'N/A' }}

---

{{-- Pesannya kita taruh di panel agar menonjol --}}
@component('mail::panel')
{{ $contactMessage->message }}
@endcomponent

**Untuk membalas, klik alamat email di atas.**

<br>
Terima kasih,<br>
Sistem Notifikasi {{ $settings->site_name ?? config('app.name') }}

{{-- 
    ======================================
    FOOTER KUSTOM (MENGHAPUS 'All rights reserved')
    ======================================
    Kita override slot 'footer' default
--}}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{ $settings->copyright_text ?? $settings->site_name }}.
    @endcomponent
@endslot
@endcomponent