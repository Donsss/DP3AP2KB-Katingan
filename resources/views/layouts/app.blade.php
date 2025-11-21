<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.scss', 'resources/js/app.js'])

    
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }
        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }
        #content {
            width: calc(100% - 250px);
            padding: 20px;
            transition: all 0.3s;
        }
        #sidebar.collapsed + #content {
            width: 100%;
        }
        #loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            
            /* Ganti warna latar belakang jika perlu */
            background-color: #FFFFFF; 
            
            /* Taruh di paling atas */
            z-index: 9999; 
            
            /* Pusatkan komponen loader Anda */
            display: flex;
            align-items: center;
            justify-content: center;
            
            /* Mulai dalam keadaan tersembunyi */
            display: none; 
        }
        @media (max-width: 768px) {
            #content {
                width: 100%;
            }
            html, body {
                overflow-x: hidden;
                width: 100%;
            }
        }
        
    </style>
</head>
<body class="font-sans antialiased">
    <div id="loader-overlay">
        <x-loading />
    </div>

    <div class="wrapper">
        @include('layouts.sidebar')

        <div id="content">
            @include('layouts.navigation')

            @isset($header)
                <header class="mb-4">
                    {{ $header }}
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggler = document.getElementById('sidebarToggle');
            const body = document.body;

            // --- FUNGSI UNTUK MENGATUR BODY SCROLL ---
            // Saat sidebar mobile terbuka, kita akan kunci scroll pada body
            function toggleBodyScroll(isSidebarOpen) {
                if (window.innerWidth <= 768) { // Hanya berlaku di mobile
                    if (isSidebarOpen) {
                        body.style.overflow = 'hidden';
                    } else {
                        body.style.overflow = 'auto';
                    }
                }
            }

            // --- LOGIKA UNTUK TOMBOL TOGGLE BAWAAN ---
            if (sidebarToggler) {
                sidebarToggler.addEventListener('click', function (event) {
                    // Mencegah event klik menyebar ke document listener di bawah
                    event.stopPropagation();
                    
                    sidebar.classList.toggle('collapsed');
                    
                    // Cek status sidebar SETELAH di-toggle
                    const isSidebarOpen = sidebar.classList.contains('collapsed');
                    toggleBodyScroll(isSidebarOpen);
                });
            }

            // --- KODE BARU: MENUTUP SIDEBAR SAAT KLIK DI LUAR AREA ---
            document.addEventListener('click', function (event) {
                // Cek apakah kita di tampilan mobile DAN sidebar sedang terbuka
                const isMobile = window.innerWidth <= 768;
                const isSidebarOpen = sidebar.classList.contains('collapsed');

                if (isMobile && isSidebarOpen) {
                    // Cek apakah yang di-klik BUKAN bagian dari sidebar
                    // dan juga BUKAN tombol toggler itu sendiri
                    const isClickInsideSidebar = sidebar.contains(event.target);
                    const isClickOnToggler = sidebarToggler ? sidebarToggler.contains(event.target) : false;
                    
                    if (!isClickInsideSidebar && !isClickOnToggler) {
                        sidebar.classList.remove('collapsed');
                        toggleBodyScroll(false); // Buka kembali kunci scroll body
                    }
                }
            });

            const loaderOverlay = document.getElementById('loader-overlay');

            // 2. Fungsi untuk menampilkan loader
            function showLoader() {
                if(loaderOverlay) {
                    // Kita pakai 'flex' karena CSS overlay-nya pakai flexbox
                    loaderOverlay.style.display = 'flex'; 
                }
            }

            // 3. Fungsi untuk menyembunyikan loader
            function hideLoader() {
                if(loaderOverlay) {
                    loaderOverlay.style.display = 'none';
                }
            }

            // 4. Tampilkan loader saat link diklik
            // Kita cari semua link di dalam dokumen
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', (e) => {
                    const href = link.getAttribute('href');
                    
                    // Ini adalah filter PENTING:
                    // Kita tidak mau loader muncul jika user cuma klik:
                    // - Link dropdown (data-bs-toggle)
                    // - Link tab (data-bs-toggle)
                    // - Link "#" (hash link)
                    // - Link yang membuka tab baru (target="_blank")
                    // - Link javascript (javascript:)
                    if (href && 
                        href !== '#' && 
                        !href.startsWith('#') && 
                        !href.startsWith('javascript:') && 
                        !link.hasAttribute('data-bs-toggle') && 
                        !link.classList.contains('gallery-lightbox') &&
                        link.getAttribute('target') !== '_blank') 
                    {
                        showLoader();
                    }
                });
            });

            // 5. Tampilkan loader saat form di-submit (Create, Edit, Delete, Logout)
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', () => {
                    // Cek jika form punya target '_blank' (jarang, tapi mungkin)
                    if(form.getAttribute('target') !== '_blank') {
                        showLoader();
                    }
                });
            });

            // 6. Sembunyikan loader saat halaman BARU selesai dimuat
            // 'pageshow' adalah event spesial yang juga aktif
            // saat user menekan tombol "Back" di browser.
            window.addEventListener('pageshow', () => {
                hideLoader();
            });
            
            // 7. (Opsional tapi disarankan) Sembunyikan jika halaman gagal loading
            // Jika server error, 'pageshow' mungkin tidak jalan.
            // Ini memastikan loader tidak nyangkut selamanya.
            window.addEventListener('error', () => {
                hideLoader();
            });
        });
    </script>
</body>
</html>