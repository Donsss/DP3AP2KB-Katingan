<x-user-components.layout>
    
    <x-slot name="title">
        Hubungi Kami - {{ $settings->site_name ?? 'Website DP3A' }}
    </x-slot>

    <section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bolder">Hubungi Kami</h2>
            <p class="text-muted">Kami siap membantu Anda. Hubungi kami melalui detail di bawah ini atau kirimkan pesan kepada kami.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h6 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Terjadi Kesalahan</h6>
                <ul class="mb-0 small ps-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="row g-5">

            <div class="col-lg-7">
                <h4 class="fw-bold mb-4">Informasi Kontak</h4>
                
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="contact-card h-100">
                            <div class="contact-card-icon mb-3"><i class="bi bi-geo-alt-fill"></i></div>
                            <h5 class="fw-bold">Alamat Kantor</h5>
                            <p class="text-muted mb-0">{{ $settings->alamat ?? 'Alamat belum diatur.' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-card h-100">
                            <div class="contact-card-icon mb-3"><i class="bi bi-telephone-fill"></i></div>
                            <h5 class="fw-bold">Telepon</h5>
                            <div class="text-muted mb-0">
                                @forelse($settings->telepon ?? [] as $tel)
                                    <a href="tel:{{ $tel }}" class="text-decoration-none text-muted d-block">{{ $tel }}</a>
                                @empty
                                    <p class="mb-0">Nomor belum diatur.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-card h-100">
                            <div class="contact-card-icon mb-3"><i class="bi bi-clock-fill"></i></div>
                            <h5 class="fw-bold">Jam Operasional</h5>
                            <div class="text-muted mb-0">
                                @forelse($settings->jam_kerja ?? [] as $jam)
                                    <span class="d-block">{{ $jam }}</span>
                                @empty
                                    <p class="mb-0">Jam operasional belum diatur.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                @if($settings && !empty($settings->google_map_url))
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4 class="fw-bold mb-4 mt-3">Lokasi Kami</h4>
                            <div class="map-container shadow-sm">
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $settings->google_map_url }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-5">
                <h4 class="fw-bold mb-4">Kirim Pesan</h4>
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('kontak.store') }}" method="POST">
                            @csrf
                            
                            <div style="position: absolute; left: -9999px;" aria-hidden="true">
                                <label for="fax">Fax</label>
                                <input type="text" name="fax" id="fax" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subjek (Opsional)</label>
                                <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan Anda</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Kirim Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .contact-card {
        background-color: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 0.75rem;
        padding: 2rem;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .contact-card-icon {
        font-size: 2.5rem;
        color: #6f42c1;
    }
    .map-container {
        border-radius: 0.75rem;
        overflow: hidden;
    }
    .map-container iframe {
        border: 0;
    }
</style>
@endpush
</x-user-components.layout>