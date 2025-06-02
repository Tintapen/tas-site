@extends('layouts.overview')

@section('title', __('Product.PH2'))

@section('content')
<!-- pPage Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('template/img/page-title-bg.webp') }}');">
  <div class="container position-relative">
    <div class="row">
        <div class="col-lg-8 col-md-7">
          <h1 class="text-start">{{ __('Product.PH2') }}</h1>             
        </div>
        <div class="col-lg-4 col-md-5 text-md-right"></div>
    </div>
  </div>
</div>
<!-- End Page Title -->

<!-- Product Section -->
<section id="services" class="services section">
  <div class="container section-title" data-aos="fade-up">
    <h2>{{ __('Product.PH2') }}</h2>
    <p>{{ __('Product.PP1') }}<br></p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-5 justify-content-center">
      @foreach ($principal as $item)
        <div class="col-xl-5 col-md-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-item">
            <div class="img">
              <a href="{{ route('maincontroller.showProducts', $item->slug) }}" class="stretched-link">
              <img src="{{ asset('storage/' . $item->logo) }}" class="img-fluid" alt="{{ $item->name }}">
            </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
<!-- /Product Section -->
@endsection