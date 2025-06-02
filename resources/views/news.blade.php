@extends('layouts.overview')

@section('title', __('News.NH1'))

@section('content')
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('template/img/page-title-bg.webp') }}');">
  <div class="container  position-relative">
    <div class="row">
        <div class="col-lg-8 col-md-7">
          <h1 class="text-start">{{ __('News.NH1') }}</h1>             
        </div>
        <div class="col-lg-4 col-md-5 text-md-right"></div>
    </div>
  </div>
</div>
<!-- End Page Title -->

<!-- Blog Posts Section -->
<section id="blog-posts" class="blog-posts section">
  <div class="container">
    <div class="row gy-4">
      @foreach($news as $item)
        <div class="col-lg-4">
          <article>
            <div class="post-img">
              <a href="{{ route('maincontroller.showNews', $item->slug) }}"><img src="{{ asset('storage/' . $item->thumbnail) }}" alt="" class="img-fluid"></a>
            </div>
            <h2 class="title">
              <a href="{{ route('maincontroller.showNews', $item->slug) }}">{{ session('locale') == 'id' ? $item->title_id : $item->title_en }}</a>
            </h2>  
            <p>{{ date('d M Y', strtotime($item->posted_at)) }}</p>
          </article>
        </div>
      @endforeach
    </div>
  </div>
</section>
<!-- /Blog Posts Section -->
  
<!-- Blog Pagination -->
<section id="blog-pagination" class="blog-pagination section">
    <div class="container">
      <div class="d-flex justify-content-center">
        {{ $news->links() }}
      </div>
    </div>
</section>
<!-- /Blog Pagination -->
@endsection