<x-user-components.layout>

    <style>
        .organization-chart {
            display: flex;
            flex-direction: column;
            gap: 50px;
            padding: 20px;
            align-items: center;
        }

        .organization-level {
            display: flex;
            justify-content: center;
            align-items: stretch;
            flex-wrap: wrap;
            gap: 25px;
            position: relative;
            width: 100%;
        }

        .member-card {
            width: 240px;
            display: flex;
            flex-direction: column;
            text-align: center;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            overflow: hidden;
            border: none;
            padding: 1rem; 
        }

        .member-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .member-card-image {
            height: 300px;
            width: 100%;
            overflow: hidden;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin: 0;
        }

        .member-card-image .member-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .member-card-content {
            padding: 1rem 0.5rem 0.5rem 0.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            gap: 0.1rem;
        }

        .member-card-content .card-title {
            line-height: 1.3;
            font-size: 1em;
            min-height: 2.6em;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .member-card.is-spacer {
            visibility: hidden;
            border: 0;
            box-shadow: none; 
            background: transparent;
        }
        
        @media (min-width: 768px) {
            .level-2-shifted {
                position: relative;
                left: 150px;
                width: auto;
            }
        }

        @media (max-width: 767.98px) {
            .member-card.is-spacer {
                display: none; 
            }
        }
        
    </style>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 mx-auto text-center">
                    <h2 class="fw-bolder">Struktur Organisasi</h2>
                    <p class="text-muted">Mengenal jajaran pimpinan dan staf pelaksana yang berdedikasi.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="organization-chart">
                        @foreach ($bidangs as $bidang)
                            
                            @php
                                $levelClass = '';
                                if ($bidang->is_shifted) {
                                    $levelClass = 'level-2-shifted';
                                }
                            @endphp

                            <div class="organization-level {{ $levelClass }}">
                                @foreach ($bidang->anggota as $anggota)
                                
                                    @if ($anggota->is_visible)
                                        <div class="member-card" data-aos="fade-up">
                                            
                                            <div class="member-card-image">
                                                @if($anggota->foto)
                                                    {{-- Jika ada foto, tampilkan foto --}}
                                                    <img src="{{ asset('storage/' . $anggota->foto) }}" 
                                                         alt="{{ $anggota->nama }}" 
                                                         class="member-photo" loading="lazy" decoding="async">
                                                @else
                                                    {{-- Jika tidak ada foto, tampilkan ikon --}}
                                                    <i class="fas fa-user-tie fa-5x text-muted"></i>
                                                @endif
                                            </div>
                                            
                                            <div class="member-card-content">
                                                <h5 class="card-title fw-bold text-primary">{{ $anggota->nama }}</h5>
                                                <p class="card-subtitle text-muted small">{{ $anggota->jabatan }}</p>
                                                <small class="d-block text-secondary">NIP: {{ $anggota->nip ? \Illuminate\Support\Str::mask($anggota->nip, '*', 0, 6) : '-' }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="member-card is-spacer"></div>
                                    @endif
                                    
                                @endforeach
                                
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-user-components.layout>