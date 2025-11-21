<footer class="footer-custom text-white pt-5 pb-4">
    <div class="container">
        <div class="row g-5 mb-4">
            
            <div class="col-lg-4 col-md-6">
                <h5 class="fw-semibold mb-3">Tentang DP3AP2KB</h5>
                <div class="footer-divider mb-4"></div>
                <p class="small text-white-80">
                    {{ $settings['footer_about'] ?? 'Isi teks tentang kami...' }}
                </p>
            </div>

            <div class="col-lg-4 col-md-6">
                <h5 class="fw-semibold mb-3">Tautan Cepat</h5>
                <div class="footer-divider mb-4"></div>
                <ul class="list-unstyled footer-links">
                    @foreach($quickLinks as $link)
                        <li><a href="{{ $link->url }}">{{ $link->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-4 col-md-12">
                <h5 class="fw-semibold mb-3">Ikuti kami</h5>
                <div class="footer-divider mb-4"></div>
                
                <div class="d-flex gap-2">
                    
                    @if($settings && !empty($settings->facebook_url))
                        <a class="socialContainer containerFB" href="{{ $settings->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook">
                            <i class="fab fa-facebook-f social-fa-icon"></i>
                        </a>
                    @endif
                    
                    @if($settings && !empty($settings->twitter_url))
                        <a class="socialContainer containerTW" href="{{ $settings->twitter_url }}" target="_blank" rel="noopener" aria-label="Twitter">
                            <i class="fab fa-twitter social-fa-icon"></i>
                        </a>
                    @endif
                    
                    @if($settings && !empty($settings->youtube_url))
                        <a class="socialContainer containerYT" href="{{ $settings->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube">
                            <i class="fab fa-youtube social-fa-icon"></i>
                        </a>
                    @endif
                    
                    @if($settings && !empty($settings->instagram_url))
                        <a class="socialContainer containerIG" href="{{ $settings->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram">
                            <i class="fab fa-instagram social-fa-icon"></i>
                        </a>
                    @endif
                    
                    </div>
            </div>

        </div>
        <div class="border-top border-white-30 pt-3 text-center">
             <p class="small text-white-80 mb-0">Copyright © {{ date('Y') }} {{ $settings['copyright_text'] ?? 'All Rights Reserved' }}.</p>
        </div>
    </div>
</footer>

<style>
    .footer-custom {
        background-color: #bed748; 
    }

    .footer-divider {
        width: 48px;
        height: 2px;
        background-color: #01baf2; 
    }

    .text-white-80 {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .border-white-30 {
        border-color: rgba(255, 255, 255, 0.3) !important;
    }

    .footer-links {
        list-style: none;
        padding-left: 0;
    }

    .footer-links li {
        margin-bottom: 0.75rem;
        padding-left: 22px; 
        position: relative;
        transition: transform 0.3s ease;
    }


    .footer-links li::before {
        content: '\f054';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 0.7em;
        position: absolute;
        left: 0;
        top: 6px;
        color: #01baf2; 
        transition: left 0.3s ease;
    }

    .footer-links a {
        text-decoration: none;
        color: rgba(255, 255, 255, 0.8);
        transition: color 0.3s ease;
        position: relative;
        display: inline-block;
        padding-bottom: 3px;
    }

    .footer-links a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 1px; 
        background-color: #ffffff;
        bottom: 0;
        left: 0;
        transition: width 0.3s ease-in-out;
    }


    .footer-links li:hover {
        transform: translateX(8px);
    }

    .footer-links li:hover::before {
        left: -4px;
    }

    .footer-links a:hover {
        color: #ffffff;
        text-decoration: none; 
    }

    .footer-links a:hover::after {
        width: 100%;
    }
    .socialContainer {
        width: 52px;
        height: 52px;
        background-color: #01baf2; 
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: all 0.5s ease-in-out;
        border-radius: 50%;
        text-decoration: none;
    }

    .social-fa-icon {
        font-size: 20px;
        color: white;
        transition: all 0.5s ease-in-out;
    }

    .containerIG:hover {
        background-color: #d62976;
        transform: scale(1.15);
    }
    .containerTW:hover {
        background-color: #00acee;
        transform: scale(1.15);
    }
    .containerFB:hover {
        background-color: #1877F2;
        transform: scale(1.15);
    }
    .containerYT:hover {
        background-color: #FF0000;
        transform: scale(1.15);
    }

    .socialContainer:active {
        transform: scale(0.9);
        transition-duration: 0.5s;
    }

    .socialContainer:hover .social-fa-icon {
        animation: slide-in-top 0.5s both;
    }

    @keyframes slide-in-top {
        0% {
            transform: translateY(-20px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>