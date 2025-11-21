<x-user-components.layout>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-10">
                    <h2 class="fw-bolder mb-3">Visi & Misi</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="mb-5">
                        <h3 class="fw-bold mb-3" style="font-size: 2rem; color: #0d6efd;">VISI</h3>
                        <p class="text-dark" style="font-size: 1.1rem; line-height: 1.8; text-align: justify;">
                            @if(isset($data) && $data->visi)
                                "{{ $data->visi }}"
                            @else
                                "Visi belum diatur oleh administrator."
                            @endif
                        </p>
                    </div>

                    <hr class="my-5">
                    <div>
                        <h3 class="fw-bold mb-4" style="font-size: 2rem; color: #198754;">MISI</h3>
                        <ol class="text-dark" style="font-size: 1.1rem; line-height: 1; padding-left: 1.5rem;">
                            @forelse($data->misi ?? [] as $item)
                                <li class="mb-3">{{ $item }}</li>
                            @empty
                                <li class="mb-3 text-muted">Misi belum diatur oleh administrator.</li>
                            @endforelse
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <style>
        hr {
            border: 0;
            height: 2px;
            background: linear-gradient(to right, transparent, #dee2e6, transparent);
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            h3[style*="font-size: 2rem"] {
                font-size: 1.5rem !important;
            }
            
            p[style*="font-size: 1.1rem"],
            ol[style*="font-size: 1.1rem"] {
                font-size: 1rem !important;
            }
        }
    </style>
</x-user-components.layout>