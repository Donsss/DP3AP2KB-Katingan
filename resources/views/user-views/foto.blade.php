<x-user-components.layout>
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h2 class="fw-bolder border-bottom pb-3">Galeri Foto</h2>
            </div>

            <div class="row g-4">
                @forelse($photos as $photo)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="gallery-item">
                            <a href="{{ asset('storage/' . $photo->image) }}" 
                               class="gallery-lightbox" >
                                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="img-fluid">
                                <div class="gallery-overlay"><i class="bi bi-search"></i></div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada foto yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $photos->links() }}
            </div>
        </div>
    </section>

    <style>
        .gallery-item { position: relative; overflow: hidden; border-radius: 0.375rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .gallery-item img { transition: transform 0.4s ease; }
        .gallery-item:hover img { transform: scale(1.1); }
        .gallery-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; opacity: 0; transition: opacity 0.4s ease; }
        .gallery-item:hover .gallery-overlay { opacity: 1; }
        .gallery-overlay i { color: white; font-size: 2.5rem; }
        .goverlay { background: rgba(0, 0, 0, 0.9) !important; }
        .gholder { overflow: visible !important; }
        .gslide { opacity: 0.5; transform: scale(0.8); transition: transform 0.4s ease, opacity 0.4s ease; }
        .gslide.current { opacity: 1; transform: scale(1); z-index: 1; }
        .gslide.next { transform: perspective(1000px) translate3d(60%, 0, -150px); }
        .gslide.prev { transform: perspective(1000px) translate3d(-60%, 0, -150px); }
        .gslide-bottom { position: absolute; bottom: 0; left: 0; width: 100%; background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0) 100%) !important; }
        .gslide-bottom .gslide-wrapper { background: transparent !important; }
        .ginner-container .gcaption { background: transparent !important; padding: 20px 15px !important; min-height: auto; }
        .gcaption .gdesc { color: #eee !important; }
        .gcaption .gtitle { color: #fff !important; font-weight: bold; text-shadow: 0 1px 3px rgba(0,0,0,0.5); }
        .gnext, .gprev { top: 50% !important; width: 40px; height: 60px; background: rgba(0,0,0,0.2) !important; transform: translateY(-50%); }
        .gnext { right: -60px; }
        .gprev { left: -60px; }
    </style>
</x-user-components.layout>