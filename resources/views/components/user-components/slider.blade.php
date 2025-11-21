@props(['sliders'])

@if($sliders->isNotEmpty())
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($sliders as $key => $slider)
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}"></button>
        @endforeach
    </div>
    
    <div class="carousel-inner">
        @foreach($sliders as $slider)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->title ?? 'Slider Image' }}">
                
                {{--  --}}
                @if($slider->title)
                <div class="carousel-caption">
                    <h3 class="text-white text-shadow">{{ $slider->title }}</h3>
                </div>
                @endif
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<style>
    #mainCarousel {
        width: 100%;
        overflow: hidden;
    }
    
    .carousel-inner {
        width: 100%;
    }
    
    .carousel-item {
        width: 100%;
    }
    
    .carousel-item img {
        object-fit: cover;
        width: 100%;
        max-width: 100%;
        height: 100dvh;
    }
    .carousel-caption {
        bottom: 8%;
        left: 10%;
        right: 10%;
    }
    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }
    .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 5px;
    }
    @media (max-width: 768px) {
        .carousel-item img {
            height: 300px;
        }
        .carousel-caption {
            left: 5%;
            right: 5%;
        }
        .carousel-caption h3 {
            font-size: 1.2rem;
        }
        .d-flex.justify-content-center.align-items-center {
            height: 300px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.getElementById('mainCarousel');
        if(myCarousel) {
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 5000,
                pause: 'hover',
                wrap: true
            });
        }
    });
</script>

@endif