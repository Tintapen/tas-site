@extends('layouts.overview')

@section('title', __('Career.CH10'))

@section('content')
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('template/img/page-title-bg.webp') }}');">
    <div class="container position-relative">
      <div class="row">
          <div class="col-lg-8 col-md-7">
            <h1 class="text-start">{{ __('Career.CH10') }}</h1>             
          </div>
          <div class="col-lg-4 col-md-5 text-md-right"></div>
      </div>
    </div>
</div>
<!-- End Page Title -->

<div class="container">
    <div class="job-container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Header Section -->
                <div class="d-flex align-items-center mb-4">
                    <div class="me-4">
                        <div class="company-logo d-flex align-items-center justify-content-center">
                            <span style="color: #004586; font-weight: bold; font-size: 24px;">TAS</span>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-center">
                            <h1 class="job-title">{{ session('locale') == 'id' ? $job->title_id : $job->title_en }}</h1>
                        </div>
                        <div class="job-meta">
                            <span class="job-meta-item">
                                <i class="fas fa-building text-secondary"></i>
                                {{ $job->department->name ?? '-' }}
                            </span>
                            <span class="job-meta-item">
                                <i class="fas fa-map-marker-alt text-secondary"></i>
                                {{ $job->location }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mb-4">
                    <span class="badge-custom">
                        <i class="fas fa-clock me-1"></i> {{ $job->job_nature }}
                    </span>
                </div>

                <!-- Job Description -->
                {{ session('locale') == 'id' ? strip_tags($job->description_id) : strip_tags($job->description_en) }}       
            </div>

            <div class="col-lg-4">
                <div class="job-overview-card">
                    <h3 class="mb-4">{{ __('Career.CH11') }}</h3>                    
                    <div class="overview-item">
                        <span class="overview-item-label">
                            <i class="far fa-calendar-check me-2 text-primary"></i>
                            {{ __('Career.CH12') }} :
                        </span>
                        <span class="overview-item-value">{{ date('d M Y', strtotime($job->created_at)) }}</span>
                    </div>
                    <div class="overview-item">
                        <span class="overview-item-label">
                            <i class="fas fa-map-pin me-2 text-primary"></i>
                            {{ __('Career.CH13') }} :
                        </span>
                        <span class="overview-item-value">{{ $job->location }}</span>
                    </div>                    
                    <div class="overview-item">
                        <span class="overview-item-label">
                            <i class="fas fa-users me-2 text-primary"></i>
                            {{ __('Career.CH14') }} :
                        </span>
                        <span class="overview-item-value">{{ $job->vacancy }}</span>
                    </div>                    
                    <div class="overview-item">
                        <span class="overview-item-label">
                            <i class="fas fa-briefcase me-2 text-primary"></i>
                            {{ __('Career.CH15') }} :
                        </span>
                        <span class="overview-item-value">{{ $job->job_nature ?? '-' }}</span>
                    </div>                    
                    <div class="overview-item">
                        <span class="overview-item-label">
                            <i class="far fa-clock me-2 text-primary"></i>
                            {{ __('Career.CH16') }} :
                        </span>
                        <span class="overview-item-value">{{ $job->application_date ? date('d M Y', strtotime($job->application_date)) : '-' }}</span>
                    </div>                    
                </div>

                <!-- Company Information -->
                <div class="company-card">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal">{{ __('Career.CB2') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('career.apply') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="applyModalLabel">{{ __('Career.CH17') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Career.CL1') }}</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Career.CL2') }}</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="cv" class="form-label">{{ __('Career.CL3') }}</label>
                <input type="file" name="cv" class="form-control" accept="application/pdf" required>
            </div>
            <input type="hidden" name="job_title" value={{ session('locale') == 'id' ? $job->title_id : $job->title_en }}>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-primary">{{ __('Career.CB3') }}</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection