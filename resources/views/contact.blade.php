@extends('layouts.overview')

@section('title', $title)

@section('content')
  <!-- Page Title -->
  <div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('template/img/page-title-bg.webp') }}');">
    <div class="container  position-relative">
      <!-- <div class="breadcrumbs-inner bread-">  -->
      <div class="row">
          <div class="col-lg-8 col-md-7">
            <h1 class="text-start">{{ __('Contact.CH1') }}</h1>             
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
      <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
        <div class="tab-pane fade active show" id="features-tab-1">
          <div class="row">
            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 align-self-center" >
              <h1>{{ $company->name }}</h1>

              <p style="font-size: 24px;">{{ $company->address }}</p>
                <a href="{{ $location }}" target="_blank">
                  <button type="button" class="btn btn-primary btn-rounded" data-mdb-ripple-init>{{ __('Contact.CB1') }}</button>
                </a>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center">
              <img src="{{ asset('template/img/office.jpg') }}" alt="" class="img-fluid">
            </div>
          </div>
        </div>
        <!-- End Tab Content Item -->
      </div>
    </div>
  </section>
  <!-- /Features Section -->
  
  <!-- Contact Section -->
  <section id="contact" class="contact section">
    <div class="container" data-aos="fade">
      <div class="row gy-5 gx-lg-5">
        <div class="col-lg-4">
          <div class="info">
            <h3>{{ __('Contact.CH2') }}</h3>
            <p>{{ __('Contact.CP1') }}</p>

            <div class="info-item d-flex ">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h4>{{ __('Contact.CH3') }}</h4>
                <p>{{ $company->address }}</p>
              </div>
            </div>
            <!-- End Info Item -->

            <div class="info-item d-flex">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h4>{{ __('Contact.CH4') }}</h4>
                <p>{{ $company->email }}</p>
              </div>
            </div>
            <!-- End Info Item -->

            <div class="info-item d-flex">
              <i class="bi bi-phone flex-shrink-0"></i>
              <div>
                <h4>{{ __('Contact.CH5') }}</h4>
                <p>{{ $company->phone }}</p>
              </div>
            </div>
            <!-- End Info Item -->
          </div>
        </div>

        <div class="col-lg-8">
          <form action="{{ route('contact.send') }}" method="post" class="php-email-form">
            @csrf
            <div class="form-message-container">
              <div class="loading" style="display:none; text-align:center; padding:10px; background-color:#f0f0f0; color:#333; border-radius:5px;">
                  <strong>Loading...</strong>
              </div>
              <div class="error-message" style="display:none; padding:10px; background-color:#f8d7da; color:#721c24; border-radius:5px; text-align:center; border:1px solid #f5c6cb;">
                  <strong>Error!</strong> S{{ __('Contact.CD1') }}
              </div>
              <div class="sent-message" style="display:none; padding:10px; background-color:#d4edda; color:#155724; border-radius:5px; text-align:center; border:1px solid #c3e6cb;">
                  <strong>Success!</strong> {{ __('Contact.CD2') }}
              </div>
            </div>
          
            <!-- Input fields -->
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('Contact.CI1') }}" required="">
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('Contact.CI2') }}" required="">
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="{{ __('Contact.CI3') }}" required="">
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" placeholder="{{ __('Contact.CI4') }}" required=""></textarea>
            </div>
          
            <div class="text-center">
              <button type="submit">{{ __('Contact.CB2') }}</button>
            </div>
          </form>
          
        </div>
        <!-- End Contact Form -->
      </div>
    </div>
  </section>
  
  <!-- /Contact Section -->
@endsection