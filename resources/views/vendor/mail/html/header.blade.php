@php
// 1. Kita ambil data settings secara manual di sini.
// Kita bisa pakai find(1) karena kita JAMIN datanya sudah ada
// berkat 'firstOrCreate' di Controller kita.
$settings = \App\Models\Setting::find(1);
@endphp

<tr>
<td class="header">
<a href="{{ config('app.url') }}" style="display: inline-block;">
    {{-- 
        2. INI LOGIKA DINAMIS ANDA 
        Kita tidak lagi peduli dengan 'trim($slot) === 'Laravel''
        Kita ganti total logikanya.
    --}}
    @if ($settings && $settings->site_logo)
        {{-- Gunakan Logo Dinamis dari database --}}
        <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="{{ $settings->site_name ?? 'Logo' }}" style="max-height: 75px; width: auto; border: 0;" class="logo">
    @elseif ($settings && $settings->site_name)
        {{-- Fallback ke Nama Situs jika tidak ada logo --}}
        {{ $settings->site_name }}
    @else
        {{-- Fallback terakhir jika tidak ada data sama sekali --}}
        {{ config('app.name') }}
    @endif
</a>
</td>
</tr>