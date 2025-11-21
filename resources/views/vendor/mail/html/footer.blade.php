@php
// 1. Kita ambil data settings secara manual di sini.
// Kita bisa pakai find(1) karena kita JAMIN datanya sudah ada
// berkat 'firstOrCreate' di Controller kita.
$settings = \App\Models\Setting::find(1);

// 2. Siapkan teks copyright dengan fallback yang aman
$copyrightText = config('app.name'); // Default
if ($settings) {
    // Gunakan copyright_text, ATAU site_name, ATAU nama app
    $copyrightText = $settings->copyright_text ?? $settings->site_name ?? config('app.name');
}
@endphp

<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">
    
    {{-- 3. Ganti slot default dengan teks kustom Anda --}}
    © {{ date('Y') }} {{ $copyrightText }}.

</td>
</tr>
</table>
</td>
</tr>