@extends('layouts.overview')

@section('title', __('About.AH1'))
@push('mile_css')
    <link href="{{ asset('template/css/mile.css') }}" rel="stylesheet">
@endpush
@section('content')
  <!-- Page Title -->
  <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('template/img/page-title-bg.webp') }}');">
    <div class="container  position-relative">
      <!-- <div class="breadcrumbs-inner bread-">  -->
      <div class="row">
          <div class="col-lg-8 col-md-7">
            <h1 class="text-start">{{ __('About.AH1') }}</h1>             
          </div>
          <div class="col-lg-4 col-md-5 text-md-right"></div>
      </div>
      <!-- </div> -->
    </div>
  </div>
  <!-- End Page Title -->
  
  <!-- Features Section -->
  <section id="features" class="features section">
    <div class="container">
      <ul class="nav nav-tabs row  d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
        <li class="nav-item col-5" >
          <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
            <i class="bi bi-lightbulb"></i>
            <h4 class="d-none d-lg-block">{{ __('About.AH2') }}</h4>
          </a>
        </li>
        <li class="nav-item col-5">
          <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
            <i class="bi bi-bullseye"></i>
            <h4 class="d-none d-lg-block">{{ __('About.AH3') }}</h4>
          </a>
        </li>
      </ul>
      <!-- End Tab Nav -->
      
      <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
        <div class="tab-pane fade active show" id="features-tab-1">
          <div class="row">
            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 align-self-center" >
              <h1>{{ __('About.AH2') }}</h1>
              <p class="about-text">
                {{ __('About.AP1') }}
              </p>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center">
              <img src="{{ asset('template/img/working-1.jpg') }}" alt="" class="img-fluid">
            </div>
          </div>
        </div>
        <!-- End Tab Content Item -->
        
        <div class="tab-pane fade" id="features-tab-2">
          <div class="row">
            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 align-self-center">
              <h1>{{ __('About.AH3') }}</h1>
  
              <ul>
                <li><i class="bi bi-bullseye"></i> <span style="font-size: 24px;">{{ __('About.AS1') }}</span></li>
                <li><i class="bi bi-bullseye"></i> <span style="font-size: 24px;">{{ __('About.AS2') }}</span></li>
                <li><i class="bi bi-bullseye"></i> <span style="font-size: 24px;">{{ __('About.AS3') }}</span></li>
                <li><i class="bi bi-bullseye"></i> <span style="font-size: 24px;">{{ __('About.AS4') }}</span></li>
              </ul>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center">
              <img src="{{ asset('template/img/working-2.jpg') }}" alt="" class="img-fluid">
            </div>
          </div>
        </div>
        <!-- End Tab Content Item -->
      </div>
    </div>
  </section>
  <!-- /Features Section -->
  
  <!-- start milestone -->
  <section class="bsb-timeline-3 bg-light py-3 py-md-5 py-xl-8">
    
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>{{ __('About.AH4') }}</h2>
      <p>{{ __('About.AP2') }}</p>
    </div>
    <!-- End Section Title -->
    
    <div class="wrap">
      @foreach ($milestones as $index => $milestone)
        @php
          $isRight = $index % 2 === 0; // even = kiri, odd = kanan
          $circleClass = 'circle' . ($index + 1);
          $animationDelay = 0.75 * $index;
          $year = \Carbon\Carbon::parse($milestone->milestone_date)->format('Y');

          $shimClass = '';
          if ($index === 0) {
              $circleClass = 'circle1';
              $shimClass = 'shim1';
          } elseif ($isRight) {
              $circleClass = 'circle3';
          } else {
              $circleClass = 'circle2';
          }
        @endphp

        @if ($isRight)
          <div class="col col1"></div>
          <div class="col col2">
            <div class="circle {{ $circleClass }}">
              <h2>
                <span>
                    <b></b>
                    <i>{{ $year }}</i>
                </span>
              </h2>
              <div class="shim {{ $shimClass }}" style="animation-delay: {{ $animationDelay }}s"></div>
            </div>
            <div class="content">
              <h4>{{ $milestone->description }}</h4>
            </div>
          </div>
        @else
          <div class="col col1">
            <div class="circle {{ $circleClass }}">
              <h2>
                <span>
                    <b></b>
                    <i>{{ $year }}</i>
                </span>
              </h2>
              <div class="shim shimx {{ $shimClass }}" style="animation-delay: {{ $animationDelay }}s"></div>
            </div>
            <div class="content">
              <h4>{{ $milestone->description }}</h4>
            </div>
          </div>
          <div class="col col2"></div>
        @endif
      @endforeach
    </div>  
  </section>
  <!-- end milestone -->
  
  <!-- sertifikasi Section -->
  <section id="certificates" class="certificates section light-background">
    
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>{{ __('About.AH5') }}</h2>
      <p>{{ __('About.AP3') }}</p>
    </div>
    <!-- End Section Title -->
    
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
        </script>

        <div class="swiper-wrapper">
          @foreach ($certificate as $ctf)
            <div class="swiper-slide">
              <div class="certificate-item">
                <div class="profile mt-auto">
                  <img src="{{ asset('storage/' . $ctf->logo) }}" class="certificate-img" alt="">
                  <h3>{{ $ctf->name }}</h3>
                </div>
              </div>
            </div><!-- End certificate item -->
          @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>
  <!-- /certificates Section -->
  
  <!-- location Section -->
  <section id="certificates" class="certificates section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>{{ __('About.AH6') }}</h2>
      <p>{{ __('About.AP4') }}</p>
    </div>
    <!-- End Section Title -->

    <div class="container pt-5 wow zoomIn" data-wow-delay="0.1s">
      <div class="rounded h-100">
        <iframe class="rounded w-100" 
        style="height: 500px;" src="{{ $location }}" 
        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                  
      </div>
    </div>
  </section>
@endsection