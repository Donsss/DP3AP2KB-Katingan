<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Pengaturan Global') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- Navigasi Tab --}}
            <ul class="nav nav-tabs" id="settingsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">Umum</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Info Kontak</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab" aria-controls="social" aria-selected="false">Sosial Media</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="footer-tab" data-bs-toggle="tab" data-bs-target="#footer" type="button" role="tab" aria-controls="footer" aria-selected="false">Konten Footer</button>
                </li>
            </ul>

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="tab-content" id="settingsTabContent">
                    
                    {{-- TAB UMUM --}}
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="py-4">
                            <div class="mb-3">
                                <label for="site_name" class="form-label">Nama Situs</label>
                                <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name', $settings->site_name) }}">
                            </div>
                            <div class="mb-3">
                                <label for="copyright_text" class="form-label">Teks Copyright</label>
                                <input type="text" class="form-control" id="copyright_text" name="copyright_text" value="{{ old('copyright_text', $settings->copyright_text) }}" placeholder="Contoh: DP3A Katingan">
                            </div>
                            <div class="mb-3">
                                <label for="notification_email" class="form-label">Email Penerima Notifikasi</label>
                                <input type="email" class="form-control @error('notification_email') is-invalid @enderror" 
                                       id="notification_email" name="notification_email" 
                                       value="{{ old('notification_email', $settings->notification_email) }}" 
                                       placeholder="admin@website.com">
                                <div class="form-text">Email yang akan menerima semua pesan dari formulir kontak.</div>
                                @error('notification_email') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>

                            <hr class="my-4">

                            {{-- GRID LOGO: Kiri (Preview) & Kanan (Upload) --}}
                            <div class="row align-items-start">
                                {{-- Kiri: Logo Saat Ini --}}
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label fw-bold text-muted">Logo Saat Ini</label>
                                    <div class="card bg-light border">
                                        <div class="card-body text-center d-flex align-items-center justify-content-center" style="min-height: 200px;">
                                            @if($settings->site_logo)
                                                <img src="{{ asset('storage/' . $settings->site_logo) }}" 
                                                     alt="Logo Website" 
                                                     class="img-fluid rounded" 
                                                     style="max-height: 150px; max-width: 100%; object-fit: contain;">
                                            @else
                                                <div class="text-muted">
                                                    <i class="fa-regular fa-image fa-3x mb-2"></i>
                                                    <p class="small mb-0">Belum ada logo diatur</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            
                                {{-- Kanan: Upload Baru --}}
                                <div class="col-md-8">
                                    <label for="site_logo" class="form-label fw-bold">Ganti Logo Baru</label>
                                    
                                    {{-- Input FilePond (Tanpa data-file-poster agar kosong) --}}
                                    <input type="file" name="site_logo" id="site_logo">
                                    
                                    @error('site_logo') 
                                        <div class="text-danger small mt-1">{{ $message }}</div> 
                                    @enderror
                                    
                                    <div class="alert alert-info d-flex align-items-center mt-2 mb-0 py-2 px-3 small border-0 bg-opacity-10 bg-info text-info" role="alert">
                                        <i class="fa-solid fa-circle-info me-2 fa-lg"></i>
                                        <div>
                                            Format: <strong>jpg, jpeg, png, webp</strong>.<br>
                                            Ukuran Maksimal: <strong>2MB</strong>.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Akhir Grid Logo --}}

                        </div>
                    </div>

                    {{-- TAB KONTAK --}}
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="py-4">
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $settings->alamat) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="jam_kerja_input" class="form-label">Jam Kerja (Pisahkan dengan baris baru / Enter)</label>
                                <textarea class="form-control" id="jam_kerja_input" name="jam_kerja_input" rows="3" placeholder="Senin - Jumat: 08:00 - 16:00&#10;Sabtu: 08:00 - 12:00">{{ old('jam_kerja_input', $settings->jam_kerja_input) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="telepon_input" class="form-label">Nomor Telepon (Pisahkan dengan baris baru / Enter)</label>
                                <textarea class="form-control" id="telepon_input" name="telepon_input" rows="3" placeholder="0812-XXXX-XXXX&#10;(0536) XXX-XXX">{{ old('telepon_input', $settings->telepon_input) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="google_map_url" class="form-label">URL Google Maps (untuk iFrame)</label>
                                <textarea class="form-control" id="google_map_url" name="google_map_url" rows="4" placeholder="Tempelkan URL 'src' dari iframe Google Maps di sini...">{{ old('google_map_url', $settings->google_map_url) }}</textarea>
                                <div class="form-text">Contoh: <strong>https://www.google.com/maps/embed?...</strong> (Hanya URL di dalam src="...")</div>
                                @error('google_map_url') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- TAB SOSIAL MEDIA --}}
                    <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                        <div class="py-4">
                            <p class="text-muted mb-4">Isi URL lengkap (dimulai dengan https://). Kosongkan kolom untuk menyembunyikan ikon di website.</p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="facebook_url" class="form-label"><i class="fa-brands fa-facebook text-primary me-1"></i> Facebook URL</label>
                                    <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="twitter_url" class="form-label"><i class="fa-brands fa-x-twitter text-dark me-1"></i> Twitter / X URL</label>
                                    <input type="url" class="form-control" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $settings->twitter_url) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="instagram_url" class="form-label"><i class="fa-brands fa-instagram text-danger me-1"></i> Instagram URL</label>
                                    <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="youtube_url" class="form-label"><i class="fa-brands fa-youtube text-danger me-1"></i> YouTube URL</label>
                                    <input type="url" class="form-control" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $settings->youtube_url) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="whatsapp_url" class="form-label"><i class="fa-brands fa-whatsapp text-success me-1"></i> WhatsApp URL</label>
                                    <input type="url" class="form-control" id="whatsapp_url" name="whatsapp_url" value="{{ old('whatsapp_url', $settings->whatsapp_url) }}" placeholder="https://wa.me/62...">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tiktok_url" class="form-label"><i class="fa-brands fa-tiktok text-dark me-1"></i> TikTok URL</label>
                                    <input type="url" class="form-control" id="tiktok_url" name="tiktok_url" value="{{ old('tiktok_url', $settings->tiktok_url) }}" placeholder="https://www.tiktok.com/@profilanda">
                                    @error('tiktok_url') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TAB FOOTER --}}
                    <div class="tab-pane fade" id="footer" role="tabpanel" aria-labelledby="footer-tab">
                        <div class="py-4">
                            <div class="mb-3">
                                <label for="footer_about" class="form-label">Teks "Tentang" di Footer</label>
                                <textarea class="form-control" id="footer_about" name="footer_about" rows="5">{{ old('footer_about', $settings->footer_about) }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Tombol Simpan --}}
                <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-save me-2"></i> Simpan Pengaturan
                    </button>
                </div>

            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoInput = document.querySelector('input[id="site_logo"]');
            
            if (logoInput) {
                FilePond.create(logoInput, {
                    storeAsFile: true,
                    stylePanelLayout: 'integrated',
                    // Label diubah agar user paham ini untuk GANTI logo
                    labelIdle: `Seret & lepas untuk <strong>Ganti Logo</strong> atau <span class="filepond--label-action"> Telusuri </span>`,
                    
                    // Validasi (sesuai controller)
                    acceptedFileTypes: ['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'],
                    maxFileSize: '2MB',
                    
                    // Label Validasi
                    labelFileValidateTypeNotAllowed: 'Jenis file tidak valid',
                    labelMaxFileSizeExceeded: 'File terlalu besar (Maks 2MB)',
                    labelMaxFileSize: 'Ukuran file maksimum adalah {filesize}',
                });
            }
        });
    </script>
    @endpush

</x-app-layout>