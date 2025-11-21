<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KemenPPPA') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Mengambil warna dari Logo KemenPPPA */
            --primary-color: #009FE3; /* Biru Cyan Logo */
            --secondary-color: #8CC63F; /* Hijau Pupus Logo */
            --bg-gradient-start: #f0f8ff; 
            --bg-gradient-end: #dfe9f3;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        /* Background Decoration (Opsional: Pola abstrak halus) */
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23009fe3' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: -1;
        }

        .login-card {
            width: 100%;
            max-width: 450px; /* Lebar ideal untuk Center Card */
            background: #ffffff;
            border: none;
            border-radius: 12px;
            /* Border atas hijau sesuai logo untuk aksen */
            border-top: 5px solid var(--secondary-color); 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            position: relative;
        }

        .logo-wrapper {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-wrapper img {
            height: 80px; /* Sesuaikan tinggi logo */
            width: auto;
            object-fit: contain;
        }

        .app-title {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Styling untuk Form Input di dalam $slot nanti */
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(0, 159, 227, 0.1);
            background-color: #fff;
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: #008bc7; /* Sedikit lebih gelap */
            box-shadow: 0 4px 12px rgba(0, 159, 227, 0.3);
        }

        .forgot-password {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
        
        .forgot-password a {
            color: #6c757d;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .forgot-password a:hover {
            color: var(--primary-color);
        }
        
        .footer-copyright {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.75rem;
            color: #adb5bd;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="d-flex justify-content-center">
            
            <div class="login-card">

                <div class="login-form-content">
                    {{ $slot }}
                </div>

                <div class="footer-copyright">
                    &copy; {{ date('Y') }} DP3AP2KB
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>