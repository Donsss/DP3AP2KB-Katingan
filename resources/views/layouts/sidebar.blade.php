<style>
    #sidebar {
        width: 250px;
        min-width: 250px;
        background: #fff;
        color: #333;
        transition: all 0.3s;
        border-right: 1px solid #e9ecef;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        
        height: 100vh;       
        overflow-y: auto;    
        position: sticky;    
        top: 0;              
        z-index: 1000;       
        scrollbar-width: thin;
        scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
    }

    #sidebar.collapsed {
        margin-left: -250px;
    }

    #sidebar::-webkit-scrollbar {
        width: 6px; 
    }

    #sidebar::-webkit-scrollbar-track {
        background: transparent; 
    }

    #sidebar::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.1); 
        border-radius: 10px; 
    }

    #sidebar:hover::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.3);
    }

    .sidebar-header {
        padding: 15px 20px;
        display: flex; 
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #e9ecef;
        position: sticky;
        top: 0;
        background: #fff;
        z-index: 10;
    }

    .sidebar-header h3 {
        color: #333;
        margin: 0;
        font-weight: 700;
    }
    
    .sidebar-heading {
        padding: 10px 20px;
        font-size: 0.8em;
        color: #6c757d;
        text-transform: uppercase;
        font-weight: 700;
    }

    #sidebar .list-unstyled {
        margin-bottom: 20px;
    }

    #sidebar .list-unstyled a {
        padding: 10px 20px;
        display: block;
        font-size: 1em;
        color: #495057;
        text-decoration: none;
    }
    #sidebar .list-unstyled a:hover {
        color: #0d6efd;
        background: #f8f9fa;
    }
    #sidebar .list-unstyled a.active {
        color: #0d6efd;
        background: #e9ecef;
        font-weight: 600;
    }
    #sidebar .list-unstyled a i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    #sidebar a.dropdown-toggle::after {
        transition: transform 0.3s ease-in-out;
    }

    #sidebar a.dropdown-toggle:not(.collapsed)::after {
        transform: rotate(180deg);
    }

    @media (max-width: 768px) {
        #sidebar {
            position: fixed; 
            height: 100vh; 
            margin-left: -250px;
            top: 0;
            left: 0;
            bottom: 0;  
        }

        #sidebar.collapsed {
            margin-left: 0; 
            box-shadow: 5px 0 15px rgba(0,0,0,0.1);
        }

        .wrapper {
           position: relative;
        }
    }
</style>

<nav id="sidebar">
    <div class="sidebar-header">
        <div class="d-flex align-items-center justify-content-center text-start">
            <img src="{{ isset($settings) && $settings->site_logo ? asset('storage/' . $settings->site_logo) : asset('images/katingan-logo.png') }}" 
                 alt="Logo Aplikasi" 
                 style="height: 40px; width: auto; object-fit: contain;" 
                 class="me-3">

            <div>
                <h3 class="mb-0 fs-5 text-dark fw-bold">
                    {{ $settings->site_name ?? 'DP3AP2KB' }}
                </h3>
                
                <span class="small text-muted fw-bold" style="font-size: 9px;">KABUPATEN KATINGAN</span>
            </div>
        </div>
    </div>

    <ul class="list-unstyled components">
        <li class="sidebar-heading">Main</li>
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                <span><i class="fas fa-tachometer-alt"></i> Dashboard</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('sliders.index') }}" class="{{ request()->routeIs('sliders.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                <span><i class="fas fa-images"></i> Image Slider</span>
            </a>
        </li>

        <li>
            <a href="#gallerySubmenu" data-bs-toggle="collapse" 
            aria-expanded="{{ request()->routeIs('photos.*') || request()->routeIs('videos.*') ? 'true' : 'false' }}" 
            class="dropdown-toggle d-flex justify-content-between align-items-center {{ request()->routeIs('photos.*') || request()->routeIs('videos.*') ? '' : 'collapsed' }}">
                <span><i class="fas fa-photo-video"></i> Galeri</span>
            </a>
            <ul class="collapse list-unstyled ps-4 {{ request()->routeIs('photos.*') || request()->routeIs('videos.*') ? 'show' : '' }}" id="gallerySubmenu">
                <li>
                    <a href="{{ route('photos.index') }}" class="{{ request()->routeIs('photos.*') ? 'active' : '' }}">
                        <i class="fas fa-image"></i> Foto
                    </a>
                </li>
                <li>
                    <a href="{{ route('videos.index') }}" class="{{ request()->routeIs('videos.*') ? 'active' : '' }}">
                        <i class="fas fa-video"></i> Video
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ route('documents.index') }}" class="{{ request()->routeIs('documents.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Dokumen
            </a>
        </li>

        <li>
            <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Berita
            </a>
        </li>

        <li>
            <a href="{{ route('admin.agenda.index') }}" class="{{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> Agenda
            </a>
        </li>

        @php
            $unreadMessagesCount = \App\Models\ContactMessage::where('status', 'unread')->count();
        @endphp
        <li>
            <a href="{{ route('contact-messages.index') }}" class="{{ request()->routeIs('contact-messages.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-envelope-open-text"></i> Pesan Masuk
                </span>
                
                @if($unreadMessagesCount > 0)
                    <span class="badge bg-danger rounded-pill">{{ $unreadMessagesCount }}</span>
                @endif
            </a>
        </li>

        <li>
            <a href="{{ route('quick-links.index') }}" class="{{ request()->routeIs('quick-links.*') ? 'active' : '' }}">
                <i class="fas fa-link"></i> Tautan Cepat
            </a>
        </li>

        <li>
            <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> Setting
            </a>
        </li>

        <li class="sidebar-heading">Profile</li>

        <li>
            <a href="#pimpinanSubmenu" data-bs-toggle="collapse" 
               aria-expanded="{{ request()->routeIs('admin.pimpinan.*') || request()->routeIs('admin.pendidikan.*') || request()->routeIs('admin.pekerjaan.*') ? 'true' : 'false' }}" 
               class="dropdown-toggle d-flex justify-content-between align-items-center {{ request()->routeIs('admin.pimpinan.*') || request()->routeIs('admin.pendidikan.*') || request()->routeIs('admin.pekerjaan.*') ? '' : 'collapsed' }}">
                <span><i class="fas fa-user-tie"></i> Kelola Pimpinan</span>
            </a>
            <ul class="collapse list-unstyled ps-4 {{ request()->routeIs('admin.pimpinan.*') || request()->routeIs('admin.pendidikan.*') || request()->routeIs('admin.pekerjaan.*') ? 'show' : '' }}" id="pimpinanSubmenu">
                <li>
                    <a href="{{ route('admin.pimpinan.edit') }}" class="{{ request()->routeIs('admin.pimpinan.edit') ? 'active' : '' }}">
                        <i class="fas fa-id-card"></i> Data Utama
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pendidikan.index') }}" class="{{ request()->routeIs('admin.pendidikan.*') ? 'active' : '' }}">
                        <i class="fas fa-graduation-cap"></i> Riwayat Pendidikan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pekerjaan.index') }}" class="{{ request()->routeIs('admin.pekerjaan.*') ? 'active' : '' }}">
                        <i class="fas fa-briefcase"></i> Riwayat Pekerjaan
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ route('admin.tugas.edit') }}" class="{{ request()->routeIs('admin.tugas.*') ? 'active' : '' }}">
                <i class="fas fa-file-contract"></i> Tugas & Fungsi
            </a>
        </li>

        <li>
            <a href="{{ route('admin.visimisi.edit') }}" class="{{ request()->routeIs('admin.visimisi.*') ? 'active' : '' }}">
                <i class="fas fa-bullseye"></i> Visi & Misi
            </a>
        </li>

        <li>
            <a href="#strukturSubmenu" data-bs-toggle="collapse" 
               aria-expanded="{{ request()->routeIs('admin.struktur-bidang.*') || request()->routeIs('admin.struktur-anggota.*') ? 'true' : 'false' }}" 
               class="dropdown-toggle d-flex justify-content-between align-items-center {{ request()->routeIs('admin.struktur-bidang.*') || request()->routeIs('admin.struktur-anggota.*') ? '' : 'collapsed' }}">
                <span><i class="fas fa-sitemap"></i> Struktur Organisasi</span>
            </a>
            <ul class="collapse list-unstyled ps-4 {{ request()->routeIs('admin.struktur-bidang.*') || request()->routeIs('admin.struktur-anggota.*') ? 'show' : '' }}" id="strukturSubmenu">
                <li>
                    <a href="{{ route('admin.struktur-bidang.index') }}" class="{{ request()->routeIs('admin.struktur-bidang.*') ? 'active' : '' }}">
                        <i class="fas fa-bars"></i> Kelola Section (Baris)
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.struktur-anggota.index') }}" class="{{ request()->routeIs('admin.struktur-anggota.*') ? 'active' : '' }}">
                        <i class="fas fa-id-card-alt"></i> Kelola Anggota (Kartu)
                    </a>
                </li>
            </ul>
        </li>

        @can('manage users')
            <li class="sidebar-heading">Admin Area</li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i> Manajemen User
                </a>
            </li>
        @endcan
    </ul>
</nav>