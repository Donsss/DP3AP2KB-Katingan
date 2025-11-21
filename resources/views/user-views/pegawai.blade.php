<x-user-components.layout>
    <section class="py-5 bg-light">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-8 mx-auto text-center">
                    <h2 class="fw-bolder">Struktur Pegawai</h2>
                    <p class="text-muted">Kenali tim kami yang berdedikasi untuk memberikan pelayanan terbaik.</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-wrap align-items-center gap-3">

                        <div class="radio-inputs" id="statusFilterContainer">
                            <label class="radio">
                                <input type="radio" name="status-filter" value="semua" checked>
                                <span class="name">Semua Status</span>
                            </label>
                            <label class="radio">
                                <input type="radio" name="status-filter" value="asn">
                                <span class="name">ASN</span>
                            </label>
                            <label class="radio">
                                <input type="radio" name="status-filter" value="non-asn">
                                <span class="name">Non ASN</span>
                            </label>
                        </div>

                        <div style="width: 250px;">
                            <select class="form-select" id="bidangFilterContainer">
                                <option value="semua">Semua Bidang</option>
                                @foreach($bidangs as $bidang)
                                    <option value="{{ $bidang->slug }}">{{ $bidang->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4" id="employee-list">
                @forelse ($pegawais as $pegawai)
                    <div class="col-lg-3 col-md-4 col-sm-6 employee-item" data-status="{{ $pegawai->status }}" data-bidang="{{ $pegawai->bidang->slug }}">
                        <div class="card employee-card h-100 border-0 text-center">
                            <div class="card-img-top-container">
                                <img src="{{ asset('storage/' . $pegawai->photo) }}" alt="Foto {{ $pegawai->name }}">
                            </div>
                            <div class="card-body px-2 pb-2 pt-3">
                                <h5 class="card-title fw-bold text-primary mb-1">{{ $pegawai->name }}</h5>
                                <p class="card-subtitle text-muted mb-1 small">{{ $pegawai->position }}</p>
                                <small class="d-block text-secondary mt-2">NIP: {{ substr_replace($pegawai->nip, '******', 0, 6) }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">Belum ada data pegawai yang tersedia.</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        .employee-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            overflow: hidden;
            padding: 1rem;
        }
        .employee-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .card-img-top-container {
            height: 300px;
            width: 100%;
            overflow: hidden;
            background-color: #e9ecef;
            border-radius: 0.5rem;
        }
        .card-img-top-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .employee-card .card-title {
            line-height: 1.3;
            font-size: 1em;
            min-height: 2.6em; 
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
        .employee-card .card-subtitle,
        .employee-card .card-text {
            line-height: 1.4;
            font-size: 0.85em;
        }
        .employee-item.hidden {
            display: none !important;
        }
        
        .radio-inputs {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            border-radius: 0.5rem;
            background-color: #EEE;
            box-sizing: border-box;
            box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
            padding: 0.25rem;
            width: 300px;
            font-size: 14px;
        }
        .radio-inputs .radio {
            flex: 1 1 auto;
            text-align: center;
        }
        .radio-inputs .radio input {
            display: none;
        }
        .radio-inputs .radio .name {
            display: flex;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            border: none;
            padding: .5rem 0;
            color: rgba(51, 65, 85, 1);
            transition: all .15s ease-in-out;
        }
        .radio-inputs .radio input:checked + .name {
            background-color: #fff;
            font-weight: 600;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statusContainer = document.getElementById("statusFilterContainer");
            const bidangContainer = document.getElementById("bidangFilterContainer");
            const employeeItems = document.querySelectorAll(".employee-item");

            new TomSelect("#bidangFilterContainer", {
                 create: false,
                 controlInput: null
            });

            function filterEmployees() {
                const activeStatusInput = statusContainer.querySelector("input[type='radio']:checked");
                const statusFilterValue = activeStatusInput ? activeStatusInput.value : "semua";
                const bidangFilterValue = bidangContainer.value;

                employeeItems.forEach(item => {
                    const itemStatus = item.getAttribute("data-status");
                    const itemBidang = item.getAttribute("data-bidang");

                    const statusMatch = (statusFilterValue === "semua" || statusFilterValue === itemStatus);
                    const bidangMatch = (bidangFilterValue === "semua" || bidangFilterValue === itemBidang);

                    if (statusMatch && bidangMatch) {
                        item.classList.remove("hidden");
                    } else {
                        item.classList.add("hidden");
                    }
                });
            }

            statusContainer.addEventListener("change", filterEmployees);
            bidangContainer.addEventListener("change", filterEmployees);
        });
    </script>
</x-user-components.layout>