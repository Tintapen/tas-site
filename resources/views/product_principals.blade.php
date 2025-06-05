@extends('layouts.overview')

@section('title', __('Product.PH1'))

@push('style')
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- pPage Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url('{{ asset('template/img/page-title-bg.webp') }}');">
  <div class="container position-relative">
    <div class="row">
        <div class="col-lg-8 col-md-7">
          <h1 class="text-start">{{ __('Product.PH3') }}</h1>             
        </div>
        <div class="col-lg-4 col-md-5 text-md-right"></div>
    </div>
  </div>
</div>
<!-- End Page Title -->

<!-- products Start-->
<div class="container-fluid produk py-5">
  <div class="container py-5">
    <div class="row g-4">
      <div class="col-lg-12">
        @if (count($products) > 0)
          <div class="row g-4">
            <div class="col-xl-6">
              <form method="GET" action="{{ route('products.by_principal', $principal->slug) }}" class="input-group w-100 mx-auto d-flex">
                <input type="search" name="q" value="{{ request('q') }}" class="form-control p-3" placeholder="Cari produk..." aria-describedby="search-icon-1">
                <button class="input-group-text p-3" id="search-icon-1"><i class="bi bi-search"></i></button>
              </form>
            </div>
            <div class="col-5"></div>
            <div class="col-xl-1">
              <div class="dropdown">
                <button class="btn btn-primary d-flex align-items-center justify-content-center rounded" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 4px 8px;">
                  <i class="bi bi-funnel"></i>
                </button>
                <ul class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton1" style="min-width: 250px;">
                  <li>
                      <div class="form-floating mb-2">
                          <select class="form-select" id="categories1">
                              <option value="">Pilih Kategori Level 1</option>
                          </select>
                          <label for="categories1">Level 1</label>
                      </div>
                  </li>
                  <li>
                      <div class="form-floating mb-2">
                          <select class="form-select" id="categories2" disabled>
                              <option value="">Pilih Kategori Level 2</option>
                          </select>
                          <label for="categories2">Level 2</label>
                      </div>
                  </li>
                  <li>
                      <div class="form-floating mb-2">
                          <select class="form-select" id="categories3" disabled>
                              <option value="">Pilih Kategori Level 3</option>
                          </select>
                          <label for="categories3">Level 3</label>
                      </div>
                  </li>
                  <li>
                      <div class="form-floating mb-2">
                          <select class="form-select" id="categories4" disabled>
                              <option value="">Pilih Kategori Level 4</option>
                          </select>
                          <label for="categories4">Level 4</label>
                      </div>
                  </li>
                  <li>
                      <div class="form-floating mb-2">
                          <select class="form-select" id="categories5" disabled>
                              <option value="">Pilih Kategori Level 5</option>
                          </select>
                          <label for="categories5">Level 5</label>
                      </div>
                  </li>
                  <li>
                      <button id="filterButton" type="button" class="btn btn-primary w-100">Terapkan Filter</button>
                  </li>
              </ul>
              </div>
            </div>
          </div>
          <div class="row g-4 mt-3">
            <div class="col-lg-12">
              <div class="row g-4 justify-content-center">
                @foreach($products as $item)
                  <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded position-relative produk-item" style="cursor: pointer;">
                      <div class="produk-img">
                          <img src="{{ asset('storage/' . $item->logo) }}" class="img-fluid w-100 rounded-top" alt="" data-toggle="modal" data-target="#exampleModalCenter">
                      </div>
                      <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $item->category->name }}</div>
                      <div class="p-4 border border-top-0 rounded-bottom">
                          <h4>{{ $item->name }}</h4>
                      </div>
                    </div>
                  </div>
                @endforeach
                <section id="blog-pagination" class="blog-pagination section">
                    <div class="container">
                      <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                      </div>
                    </div>
                </section>
              </div>
            </div>
          </div>
        @else
          <h5>{{ __('Product.PH4') }}</h5>
        @endif
      </div>
    </div>
  </div>
</div>
<!-- products End-->
@endsection