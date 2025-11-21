@props(['pimpinan' => null])

<section class="py-5">
    <div class="container">
        @if ($pimpinan) 
            <div class="row justify-content-center align-items-center">
                
                <div class="col-lg-4 col-md-5 text-center mb-4 mb-md-0">
                    <div class="quote-image-container mx-auto">
                        <img src="{{ $pimpinan->photo ? asset('storage/'. $pimpinan->photo) : 'https://via.placeholder.com/300' }}" 
                             alt="{{ $pimpinan->name ?? 'Foto Pimpinan' }}" 
                             class="img-fluid rounded-circle">
                    </div>
                </div>
                
                <div class="col-lg-7 col-md-7">
                    <div class="quote-text-container">
                        <span class="quote-mark">“</span>
                        <blockquote class="blockquote fs-4 text-dark">
                            {{ $pimpinan->quote ?? 'Mohon isi kutipan dari halaman admin.' }}
                        </blockquote>
                        
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            <div>
                                <p class="fw-semibold mb-1">{{ $pimpinan->name ?? 'Nama Pimpinan' }}</p>
                                <p class="text-muted small mb-0">{{ $pimpinan->jabatan ?? 'Jabatan Pimpinan' }}</p>
                            </div>
                            <div>
                                <a href="{{ route('profil.pimpinan') }}" class="btn btn-custom-primary">Profil Kadis</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        @endif
    </div>
</section>

<style>
    .quote-image-container {
        position: relative;
        width: 300px;
        height: 300px;
        margin: auto;
        max-width: 100%;
    }

    .quote-image-container::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        height: 90%;
        background-color: #f5e3e4; 
        border-radius: 50%;
        z-index: 0;
    }

    .quote-image-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 2px solid #e9d1d3; 
        border-radius: 50%;
        box-sizing: border-box;
    }

    .quote-image-container img {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 100%;
        object-fit: cover;
        padding: 12px;
    }
    
    .quote-text-container {
        position: relative;
    }
    
    .quote-mark {
        font-family: serif;
        font-size: 6rem;
        font-weight: bold;
        color: #f0f0f0;
        position: absolute;
        top: -2.5rem;
        left: -1.5rem;
        line-height: 1;
        z-index: 0;
    }
    
    .quote-text-container blockquote {
        position: relative;
        z-index: 1;
    }

    .btn-custom-primary {
        background-color: #343a40;
        border-color: #343a40;
        color: #fff;
        font-weight: 500;
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-custom-primary:hover {
        background-color: #23272b;
        color: #fff;
    }
    
    @media (max-width: 768px) {
        .quote-image-container {
            width: 200px;
            height: 200px;
        }
        
        .quote-mark {
            font-size: 4rem;
            top: -1.5rem;
            left: -1rem;
        }
        
        .quote-text-container blockquote {
            font-size: 1.1rem !important;
        }
        
        .quote-text-container .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }
    }
</style>