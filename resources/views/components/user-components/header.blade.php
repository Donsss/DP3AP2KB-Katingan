<header class="bg-white shadow-sm">
    @if($settings)
    <div class="top-bar-mobile text-white d-lg-none">
        <div class="marquee-content">
            @if($settings->alamat)
            <span class="marquee-item">
                <i class="fas fa-map-marker-alt me-2"></i>
                <span>{{ $settings->alamat }}</span>
            </span>
            @endif
            @foreach($settings->jam_kerja ?? [] as $jam)
            <span class="marquee-item">
                <i class="far fa-clock me-2"></i>
                <span>{{ $jam }}</span>
            </span>
            @endforeach
            @foreach($settings->telepon ?? [] as $tel)
            <span class="marquee-item">
                <i class="fas fa-phone-alt me-2"></i>
                <span>{{ $tel }}</span>
            </span>
            @endforeach

            @if($settings->alamat)
            <span class="marquee-item">
                <i class="fas fa-map-marker-alt me-2"></i>
                <span>{{ $settings->alamat }}</span>
            </span>
            @endif
            @foreach($settings->jam_kerja ?? [] as $jam)
            <span class="marquee-item">
                <i class="far fa-clock me-2"></i>
                <span>{{ $jam }}</span>
            </span>
            @endforeach
            @foreach($settings->telepon ?? [] as $tel)
            <span class="marquee-item">
                <i class="fas fa-phone-alt me-2"></i>
                <span>{{ $tel }}</span>
            </span>
            @endforeach
        </div>
    </div>

    <div class="top-bar text-white d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center px-4 py-2">
            <div class="d-flex align-items-center">
                @if($settings->alamat)
                <i class="fas fa-map-marker-alt me-2"></i>
                <span>{{ $settings->alamat }}</span>
                @endif
            </div>
            <div class="d-flex align-items-center">
                @foreach($settings->jam_kerja ?? [] as $index => $jam)
                <div class="d-flex align-items-center {{ !$loop->last ? 'me-4' : '' }}">
                    <i class="far fa-clock me-2"></i>
                    <span>{{ $jam }}</span>
                </div>
                @endforeach
                
                @foreach($settings->telepon ?? [] as $index => $tel)
                <div class="d-flex align-items-center {{ ($settings->jam_kerja ? 'ms-4' : '') }} {{ !$loop->last ? 'me-4' : '' }}">
                    <i class="fas fa-phone-alt me-2"></i>
                    <span>{{ $tel }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container px-4">
            <a class="navbar-brand" href="{{ url('/') }}">
                @if($settings && $settings->site_logo)
                    <img src="{{ asset('storage/' . $settings->site_logo) }}" 
                         alt="{{ $settings->site_name ?? 'Logo DP3A' }}" 
                         style="height: 56px;">
                @else
                    <img src="{{ asset('images/logo-header.png') }}" 
                         alt="Logo DP3A" 
                         style="height: 56px;">
                @endif
                </a>

            <button class="navbar-toggler" type="button" id="mobileNavToggler">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-none d-lg-block" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is(['kadis', 'tugas', 'visi-misi', 'pegawai*', 'data-pegawai', 'profil-pimpinan', 'struktur-organisasi']) ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                            Profil <i class="fas fa-chevron-down desktop-dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Request::is('profil-pimpinan') ? 'active' : '' }}" href="{{ route('profil.pimpinan') }}">Kepala Dinas</a></li>
                            <li><a class="dropdown-item {{ Request::is('tugas') ? 'active' : '' }}" href="{{ route('tugas') }}">Tugas dan Fungsi</a></li>
                            <li><a class="dropdown-item {{ Request::is('visi-misi') ? 'active' : '' }}" href="{{ route("visi-misi") }}">Visi dan Misi</a></li>
                            <li><a class="dropdown-item {{ Request::is('struktur-organisasi') ? 'active' : '' }}" href="{{ route('struktur-organisasi') }}">Struktur Organisasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('berita*') ? 'active' : '' }}" href="{{ route('berita.index') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dokumen*') ? 'active' : '' }}" href="{{ route('dokumen.index') }}">Dokumen</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is(['foto', 'video']) ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                            Galeri <i class="fas fa-chevron-down desktop-dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Request::is('foto') ? 'active' : '' }}" href="{{ route('foto') }}">Foto</a></li>
                            <li><a class="dropdown-item {{ Request::is('video') ? 'active' : '' }}" href="{{ route('video') }}">Video</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="mobile-nav-overlay"></div>
<div class="mobile-nav-canvas" id="mobileNavCanvas">
    <div class="mobile-nav-header">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo-header.png') }}" alt="Logo" class="mobile-nav-logo">
        </a>
        <button class="btn-close" id="mobileNavClose"></button>
    </div>
    <div class="mobile-nav-body">
        {{-- Menu items diduplikasi oleh JavaScript --}}
    </div>
    
    <div class="mobile-nav-footer">
        @if($settings->facebook_url)
        <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        @endif
        @if($settings->instagram_url)
        <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener" class="social-icon"><i class="fab fa-instagram"></i></a>
        @endif
        @if($settings->youtube_url)
        <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener" class="social-icon"><i class="fab fa-youtube"></i></a>
        @endif
        @if($settings->whatsapp_url)
        <a href="{{ $settings->whatsapp_url }}" target="_blank" rel="noopener" class="social-icon"><i class="fab fa-whatsapp"></i></a>
        @endif
    </div>
</div>


<style>
    .top-bar-mobile {
        background-color: #bed748;
        font-size: 15px;
        overflow: hidden;
        white-space: nowrap;
        padding: 0.5rem 0;
    }
    .marquee-content {
        display: inline-block;
        animation: marquee-scroll 30s linear infinite; 
    }
    .marquee-item {
        display: inline-block;
        margin-right: 2rem;
    }
    @keyframes marquee-scroll {
        0% { 
            transform: translateX(0); 
        }
        100% { 
            transform: translateX(-50%); 
        }
    }
    
    .top-bar {
        background-color: #bed748;
        font-size: 15px;
    }
    .navbar .nav-link {
        color: #212529;
        transition: color 0.3s ease-in-out;
        position: relative;
        padding-bottom: 8px;
    }
    .navbar .nav-link:hover,
    .navbar .nav-link:focus,
    .navbar .nav-link.active {
        color: #01baf2;
    }
    .navbar .nav-link:not(.dropdown-toggle)::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        background: #01baf2;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        transition: width 0.3s ease-in-out;
    }
    .navbar .nav-link:not(.dropdown-toggle):hover::after,
    .navbar .nav-link:not(.dropdown-toggle).active::after {
        width: 100%;
    }
    .nav-link.dropdown-toggle::after {
       display: none;
    }
    .desktop-dropdown-icon {
        font-size: 0.7em;
        margin-left: 5px;
        opacity: 0.7;
    }
    .dropdown-item.active,
    .dropdown-item:active {
        background-color: #01baf2;
        color: white;
    }
    .navbar-brand img {
        display: block;
        max-width: 100%;
        height: auto;
    }
    
    .mobile-nav-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0s 0.3s;
    }
    .mobile-nav-overlay.active {
        opacity: 1;
        visibility: visible;
        transition: opacity 0.3s ease;
    }
    .mobile-nav-canvas {
        position: fixed;
        top: 0;
        right: -300px;
        width: 300px;
        height: 100%;
        background-color: #fff;
        z-index: 1045;
        transition: right 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        box-shadow: -5px 0 15px rgba(0,0,0,0.1);
    }
    .mobile-nav-canvas.active {
        right: 0;
    }
    .mobile-nav-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #dee2e6;
    }
    .mobile-nav-logo {
        height: 40px;
    }
    .mobile-nav-body {
        padding: 1rem;
        flex-grow: 1;
        overflow-y: auto;
    }
    .mobile-nav-body .navbar-nav {
        flex-direction: column;
        width: 100%;
    }
    .mobile-nav-body .nav-item {
        width: 100%;
        border-bottom: 1px solid #f0f0f0;
    }
     .mobile-nav-body .nav-item:last-child {
        border-bottom: none;
    }
    .mobile-nav-body .nav-link {
        padding: 0.8rem 0.5rem;
        font-weight: 500;
        color: #333;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .mobile-nav-body .nav-link.active {
        color: #01baf2;
    }
    .mobile-nav-body .nav-link::after {
        display: none !important;
    }

    .mobile-nav-body .dropdown-toggle::after {
        content: '\f054' !important;
        font-family: 'Font Awesome 6 Free' !important;
        font-weight: 900 !important;
        display: inline-block !important;
        border: none !important;
        vertical-align: middle !important;
        transform: rotate(0deg);
        transition: transform 0.3s ease-in-out;
    }
    .mobile-nav-body .dropdown-toggle.show::after {
         transform: rotate(90deg);
    }
    .mobile-nav-body .dropdown-menu {
        position: static;
        border: none;
        box-shadow: none;
        padding: 0 0 0 1rem;
        margin-top: 0;
        display: none;
        background-color: transparent;
    }
    .mobile-nav-body .dropdown-menu.show {
        display: block;
    }
    .mobile-nav-body .dropdown-item {
        padding: 0.6rem 0.5rem;
        font-size: 0.9em;
        color: #555;
    }
     .mobile-nav-body .dropdown-item.active {
        background: none;
        color: #01baf2;
        font-weight: bold;
    }
    .mobile-nav-footer {
        padding: 1rem;
        text-align: center;
        border-top: 1px solid #dee2e6;
        background-color: #fff;
    }
    .mobile-nav-footer .social-icon {
        background-color: transparent !important;
        border-radius: 0 !important;
        width: auto !important;
        height: auto !important;
        line-height: 1 !important;
        color: #212529 !important;
        margin: 0 0.75rem;
        font-size: 1.5rem;
        transition: color 0.2s ease;
    }
    .mobile-nav-footer .social-icon:hover {
        color: #777 !important;
    }
    @media (max-width: 991.98px) {
        header {
            overflow-x: hidden;
        }
        .navbar-brand img {
            max-width: 180px;
            height: auto;
        }
    }
</style>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const mobileNavToggler = document.getElementById('mobileNavToggler');
    const mobileNavCanvas = document.getElementById('mobileNavCanvas');
    const mobileNavClose = document.getElementById('mobileNavClose');
    const mobileNavOverlay = document.querySelector('.mobile-nav-overlay');
    const mainNavbar = document.getElementById('mainNavbar');
    const mobileNavBody = document.querySelector('.mobile-nav-body');

    if (mainNavbar) {
        const desktopNav = mainNavbar.querySelector('.navbar-nav').cloneNode(true);
        desktopNav.querySelectorAll('.desktop-dropdown-icon').forEach(icon => icon.remove());
        mobileNavBody.appendChild(desktopNav);
    }

    function openNav() {
        mobileNavCanvas.classList.add('active');
        mobileNavOverlay.classList.add('active');
    }

    function closeNav() {
        mobileNavCanvas.classList.remove('active');
        mobileNavOverlay.classList.remove('active');
    }

    if (mobileNavToggler) {
        mobileNavToggler.addEventListener('click', openNav);
    }
    
    if (mobileNavClose) {
        mobileNavClose.addEventListener('click', closeNav);
    }

    if (mobileNavOverlay) {
        mobileNavOverlay.addEventListener('click', closeNav);
    }

    const mobileDropdowns = mobileNavBody.querySelectorAll('.dropdown-toggle');
    mobileDropdowns.forEach(toggle => {
        toggle.removeAttribute('data-bs-toggle');
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdownMenu = this.nextElementSibling;
            this.classList.toggle('show');
            if(dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')){
                dropdownMenu.classList.toggle('show');
            }
        });
    });
});
</script>