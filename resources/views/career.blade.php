@extends('layouts.overview')

@section('title', __('Career.CH1'))

@push('career')
    <link href="{{ asset('template/css/career.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('template/img/page-title-bg.webp') }}');">
    <div class="container position-relative">
      <div class="row">
          <div class="col-lg-8 col-md-7">
            <h1 class="text-start">{{ __('Career.CH1') }}</h1>             
          </div>
          <div class="col-lg-4 col-md-5 text-md-right"></div>
      </div>
    </div>
</div>
<!-- End Page Title -->
  
<!-- Top Section with Hands and Logo -->
<section class="top-section py-4">    
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <img src="{{ asset('storage/logos/teamwork.png') }}" alt="Collaboration Hands" class="img-fluid">
            </div>
            <div class="col-md-5">
                <div class="logo-container">
                    <img src="{{ $logo }}" alt="Logo" class="logo">
                </div>
                <p class="mt-4" style="text-align: justify; font-size: 20px">
                    {{ __('Career.CP1') }}
                </p>
            </div>
        </div>
    </div>
</section>
  
<!-- Values Section -->
<section class="values-section py-5">
    <div class="container">
        <h2 class="text-center">{{ __('Career.CH2') }}</h2>
        <p class="section-description text-center">
            {!! __('Career.CP2') !!}
        </p>
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <div class="value-card b2">
                    <h5>{{ __('Career.CH3') }}</h5>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="value-card b1">
                    <h5>{{ __('Career.CH4') }}</h5>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="value-card b2">
                    <h5>{{ __('Career.CH5') }}</h5>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="value-card b1">
                    <h5>{{ __('Career.CH6') }}</h5>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="value-card b2">
                    <h5>{{ __('Career.CH7') }}</h5>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="value-card b1">
                    <h5>{{ __('Career.CH8') }}</h5>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="value-card b2">
                    <h5>{{ __('Career.CH9') }}</h5>
                </div>
            </div>
        </div>
    </div>
</section>

@if (count($job) > 0)
    <section  class="karir">
        <div class="container section-title product-title" data-aos="fade-up">
        <p>{{ __('Career.CP3') }}</p>
        </div>

        <div class="container py-5">
            <div class="row">
                <div class="col-12" id="job-list">
                    @foreach ($job as $item)
                        <div class="job-card">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="job-title">{{ session('locale') == 'id' ? $item->title_id : $item->title_en }}</h4>
                                    <p class="job-location"><i class="fas fa-location-dot"></i> {{ $item->location }}</p>
                                    <div class="badge-container">
                                        <span class="badge-icon">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span class="badge-text">{{ $item->job_type }}</span>
                                    </div>                                    
                                    <div class="badge-container">
                                        <span class="badge-icon">
                                            <i class="fas fa-briefcase"></i>
                                        </span>
                                        <span class="badge-text">{{ $item->department->name ?? '-' }}</span>
                                    </div>
                                    <div class="badge-container">
                                        <span class="badge-icon">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                        <span class="badge-text">{{ date('d M Y', strtotime($item->created_at)) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-end">
                                    <a href="{{ route('maincontroller.showCareer', $item->slug) }}" class="btn btn-detail">{{ __('Career.CA1') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center">
                        <button id="load-more-btn" class="btn btn-more" data-offset="{{ count($job) }}">{{ __('Career.CB1') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- /Contact Section -->
@endsection