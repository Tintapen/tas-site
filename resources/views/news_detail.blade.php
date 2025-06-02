@extends('layouts.overview')

@section('title', __('News.NH1'))

@section('content')
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('template/img/page-title-bg.webp') }}');">
    <div class="container position-relative">
      <div class="row">
        <div class="col-lg-8 col-md-7">
            <h1 class="text-start">{{ __('News.NH1') }}</h1>             
        </div>
        <div class="col-lg-4 col-md-5 text-md-right"></div>
      </div>
    </div>
</div>
<!-- End Page Title -->

<div class="container">
    <div class="row">
        <div class="col-lg">
            <section id="blog-details" class="blog-details section">
                <div class="container">
                    <article class="article ">
                        <h2 class="title">{{ session('locale') == 'id' ? $news->title_id : $news->title_en }}</h2>
                        <div class="content">
                            {!! session('locale') == 'id' ? $news->content_id : $news->content_en !!}
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection