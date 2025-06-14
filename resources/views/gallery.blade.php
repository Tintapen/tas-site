@extends('layouts.overview')

@section('title', __('Gallery.GH1'))

@section('content')
  <!-- Page Title -->
  <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('template/img/page-title-bg.webp') }}');">
    <div class="container  position-relative">
      <!-- <div class="breadcrumbs-inner bread-">  -->
      <div class="row">
          <div class="col-lg-8 col-md-7">
            <h1 class="text-start">{{ __('Gallery.GH1') }}</h1>             
          </div>
          <div class="col-lg-4 col-md-5 text-md-right"></div>
      </div>
      <!-- </div> -->
    </div>
  </div>
  <!-- End Page Title -->

  <!-- gallery Section -->
  <section id="portfolio" class="portfolio section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('Gallery.GH1') }}</h2>
        <p>{{ __('Gallery.GP1') }}</p>
      </div>
      <!-- End Section Title -->

      <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            @foreach ($galleryGroups as $value => $name)
                <li data-filter=".filter-{{ $value }}">{{ $name }}</li>
            @endforeach
          </ul>
          <!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
            @foreach ($galleries as $item)
              <div class="col-lg-4 col-md-6 isotope-item filter-{{ $item->group }}">
                <div class="portfolio-item">
                  <img src="{{ asset('storage/' . $item->logo) }}" class="portfolio-image" alt="{{ $item->group }}">
                  <div class="portfolio-info">
                    <a href="{{ asset('storage/' . $item->logo) }}"
                       title="{{ $item->group }}"
                       data-gallery="portfolio-gallery"
                       class="glightbox preview-link">
                       <i class="bi bi-zoom-in"></i>
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>        
        </div>
      </div>
    </section>
    <!-- /gallery Section -->
@endsection