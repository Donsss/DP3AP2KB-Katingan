<x-user-components.layout>
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            
            <div class="row mb-5">
                <div class="col-md-8 mx-auto text-center">
                    <h2 class="fw-bolder">Profil Pimpinan</h2>
                    <p class="text-muted">Mengenal lebih dekat Kepala Dinas yang memimpin kami.</p>
                </div>
            </div>

            @if ($pimpinan)
                
                <div class="row g-5">
                    
                    <div class="col-lg-4 text-center">
                        <div class="profile-pic-container">
                            <img src="{{ $pimpinan->photo ? asset('storage/' . $pimpinan->photo) : 'https://via.placeholder.com/500x500.png?text=Foto+Pimpinan' }}" 
                                 class="img-fluid rounded-3 shadow-lg" 
                                 alt="Foto Kepala Dinas">
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <h3 class="fw-bold mb-3 text-primary">{{ $pimpinan->name }}</h3>
                        <dl class="row g-3">
                            <dt class="col-sm-4 fw-semibold">NIP</dt>
                            <dd class="col-sm-8"><span class="d-none d-sm-inline">: </span>{{ $pimpinan->nip ? \Illuminate\Support\Str::mask($pimpinan->nip, '*', 0, 6) : '-' }}</dd>

                            <dt class="col-sm-4 fw-semibold">Pangkat/Golongan</dt>
                            <dd class="col-sm-8"><span class="d-none d-sm-inline">: </span>{{ $pimpinan->pangkat_golongan ?? '-' }}</dd>

                            <dt class="col-sm-4 fw-semibold">Tempat, Tanggal Lahir</dt>
                            <dd class="col-sm-8"><span class="d-none d-sm-inline">: </span>{{ $pimpinan->tempat_lahir ?? '-' }}, {{ $pimpinan->tanggal_lahir ? \Carbon\Carbon::parse($pimpinan->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</dd>

                            <dt class="col-sm-4 fw-semibold">Alamat Rumah</dt>
                            <dd class="col-sm-8"><span class="d-none d-sm-inline">: </span>{{ $pimpinan->alamat ?? '-' }}</dd>
                            
                            <dt class="col-sm-4 fw-semibold">Agama</dt>
                            <dd class="col-sm-8"><span class="d-none d-sm-inline">: </span>{{ $pimpinan->agama ?? '-' }}</dd>
                        </dl>
                        
                        <hr class="my-4">

                        <div class="riwayat-section">
                            <h4 class="fw-bold mb-3"><i class="fas fa-graduation-cap me-2"></i>Riwayat Pendidikan</h4>
                            <ul class="list-unstyled timeline">
                                @forelse ($riwayatPendidikan as $riwayat)
                                    <li>
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h5 class="timeline-title">{{ $riwayat->judul }}</h5>
                                                <p><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> {{ $riwayat->keterangan }}</small></p>
                                            </div>
                                            <div class="timeline-body">
                                                <p>{{ $riwayat->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li>
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <p class="text-muted">Data riwayat pendidikan belum tersedia.</p>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        
                        <div class="riwayat-section mt-4">
                            <h4 class="fw-bold mb-3"><i class="fas fa-briefcase me-2"></i>Riwayat Pekerjaan</h4>
                            <ul class="list-unstyled timeline">
                                @forelse ($riwayatPekerjaan as $riwayat)
                                    <li>
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h5 class="timeline-title">{{ $riwayat->judul }}</h5>
                                                <p><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> {{ $riwayat->keterangan }}</small></p>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li>
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <p class="text-muted">Data riwayat pekerjaan belum tersedia.</p>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

            @else
                <div class="row">
                    <div class="col text-center">
                        <p class="text-muted">Data pimpinan belum diatur oleh administrator.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <style>
        .profile-pic-container { max-width: 350px; margin: auto; }
        .timeline { position: relative; padding-left: 30px; border-left: 2px solid #e9ecef; }
        .timeline li { position: relative; margin-bottom: 20px; }
        .timeline .timeline-badge { position: absolute; top: 5px; left: -39px; width: 15px; height: 15px; border-radius: 50%; background-color: #6c757d; border: 2px solid #f8f9fa; }
        .timeline .timeline-panel { position: relative; }
        .timeline .timeline-heading .timeline-title { font-size: 1.1rem; font-weight: 600; }
        .timeline .timeline-body p { margin-bottom: 0; }
    </style>
</x-user-components.layout>