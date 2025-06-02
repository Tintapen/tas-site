@foreach ($jobs as $item)
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
