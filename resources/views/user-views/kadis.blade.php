<x-user-components.layout>
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 mx-auto text-center">
                    <h2 class="fw-bolder">Profil Pimpinan</h2>
                    <p class="text-muted">Mengenal lebih dekat Kepala Dinas yang memimpin kami.</p>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 text-center">
                    <div class="profile-pic-container">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Kepala_Badan_Koordinasi_Penanaman_Modal_Bahlil_Lahadalia_%28cropped%29.jpg/500px-Kepala_Badan_Koordinasi_Penanaman_Modal_Bahlil_Lahadalia_%28cropped%29.jpg" 
                             class="img-fluid rounded-3 shadow-lg" 
                             alt="Foto Kepala Dinas">
                    </div>
                </div>

                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3 text-primary">DR. NOEGROHO EDY RIJANTO, M.Kes.</h3>
                    <dl class="row g-3">
                        <dt class="col-sm-4 fw-semibold">NIP</dt>
                        <dd class="col-sm-8">: 197001012000011001</dd>

                        <dt class="col-sm-4 fw-semibold">Pangkat/Golongan</dt>
                        <dd class="col-sm-8">: Pembina Utama Muda (IV/c)</dd>

                        <dt class="col-sm-4 fw-semibold">Tempat, Tanggal Lahir</dt>
                        <dd class="col-sm-8">: Yogyakarta, 01 Januari 1970</dd>

                        <dt class="col-sm-4 fw-semibold">Alamat Rumah</dt>
                        <dd class="col-sm-8">: Jl. Merdeka No. 123, Kota Sejahtera</dd>
                        
                        <dt class="col-sm-4 fw-semibold">Agama</dt>
                        <dd class="col-sm-8">: Islam</dd>
                    </dl>
                    
                    <hr class="my-4">

                    <div class="riwayat-section">
                        <h4 class="fw-bold mb-3"><i class="fas fa-graduation-cap me-2"></i>Riwayat Pendidikan</h4>
                        <ul class="list-unstyled timeline">
                            <li>
                                <div class="timeline-badge"></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h5 class="timeline-title">S3 - Ilmu Kesehatan Masyarakat</h5>
                                        <p><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Lulus 2010</small></p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Universitas Sebelas Maret</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge"></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h5 class="timeline-title">S2 - Magister Kesehatan</h5>
                                        <p><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Lulus 2005</small></p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Universitas Gadjah Mada</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="riwayat-section mt-4">
                        <h4 class="fw-bold mb-3"><i class="fas fa-briefcase me-2"></i>Riwayat Pekerjaan</h4>
                        <ul class="list-unstyled timeline">
                            <li>
                                <div class="timeline-badge"></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h5 class="timeline-title">Kepala Dinas DP3A</h5>
                                        <p><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> 2020 - Sekarang</small></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge"></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h5 class="timeline-title">Sekretaris Dinas Kesehatan</h5>
                                        <p><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> 2015 - 2020</small></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .profile-pic-container {
            max-width: 350px;
            margin: auto;
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
            border-left: 2px solid #e9ecef;
        }

        .timeline li {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline .timeline-badge {
            position: absolute;
            top: 5px;
            left: -39px;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #6c757d;
            border: 2px solid #f8f9fa;
        }
        
        .timeline .timeline-panel {
            position: relative;
        }

        .timeline .timeline-heading .timeline-title {
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .timeline .timeline-body p {
            margin-bottom: 0;
        }
    </style>
</x-user-components.layout>