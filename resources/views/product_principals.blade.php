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
              <form method="GET" action="{{ route('products.by_principal', $principal->slug) }}" class="input-group w-100 mx-auto d-flex" id="filterForm">
                <input type="search" name="q" value="{{ request('q') }}" class="form-control p-3" placeholder="{{ __('Product.PP1') }}" aria-describedby="search-icon-1">
                <input type="hidden" name="category" id="selectedCategory" id="selectedCategory" value="{{ $selectedCategoryName }}">
                <button class="input-group-text p-3" id="search-icon-1"><i class="bi bi-search"></i></button>
              </form>
            </div>
            <div class="col-5"></div>
            <div class="col-xl-1">
              <div class="dropdown">
                <button class="btn btn-primary d-flex align-items-center justify-content-center rounded" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 4px 8px;">
                  <i class="bi bi-funnel"></i>
                </button>
                <ul class="dropdown-menu p-3" style="min-width: 250px;">
                  <li>
                      <div class="form-floating mb-2">
                          <select class="form-select" id="categories1">
                              <option value="">{{ __('Product.PO1') }} 1</option>
                              @foreach ($categoriesTree as $cat)
                                  <option value="{{ $cat->id }}" data-children='@json($cat->childrenRecursive)' {{ isset($categoryPath[0]) && $categoryPath[0]->id == $cat->id ? 'selected' : '' }}>
                                      {{ $cat->name }}
                                  </option>
                              @endforeach
                          </select>
                          <label for="categories1">Level 1</label>
                      </div>
                  </li>

                  @for ($i = 2; $i <= 5; $i++)
                      <li>
                          <div class="form-floating mb-2 category-wrapper" id="wrapper{{ $i }}" style="display: none;">
                              <select class="form-select" id="categories{{ $i }}" disabled>
                                  <option value="">>{{ __('Product.PO1') }} {{ $i }}</option>
                              </select>
                              <label for="categories{{ $i }}">Level {{ $i }}</label>
                          </div>
                      </li>
                  @endfor

                  <li>
                      <button id="filterButton" type="button" class="btn btn-primary w-100">{{ __('Product.PB1') }}</button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row g-4 mt-3">
            <div class="col-lg-12">
              <div class="product-grid">
                @foreach($products as $item)
                  <div class="product-card">
                    <div class="product-image">
                      <img src="{{ asset('storage/' . $item->logo) }}" 
                          alt="{{ $item->name }}" 
                          data-bs-toggle="modal" 
                          data-bs-target="#productModal{{ $item->id }}">

                      <div class="category-label">
                          {{ $item->category->name }}
                      </div>
                    </div>
                    <div class="product-name">{{ $item->name }}</div>
                  </div>

                  <!-- Modal Per Produk -->
                  <div class="modal fade" id="productModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                      <div class="modal-content p-0 border-0 rounded-3 overflow-hidden shadow">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

                        <div class="row g-0" style="max-height: 90vh;">
                          <!-- Bagian Gambar (Putih) -->
                          <div class="col-md-6 bg-white d-flex align-items-center justify-content-center" style="min-height: 320px;">
                              <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->name }}" class="img-fluid p-3" style="max-height: 300px; object-fit: contain;">
                          </div>

                          <!-- Bagian Keterangan (Abu Muda) -->
                          <div class="col-md-6 p-4 d-flex flex-column justify-content-between" style="background-color: #f8f9fa; max-height: 90vh; overflow-y: auto;">
                            <div>
                              <h4 class="fw-bold mb-3 text-primary">{{ $item->name }}</h4>
                              <div class="text-dark small mb-3" style="line-height: 1.7;">
                                {{ session('locale') == 'id' ? strip_tags($item->content_id) : strip_tags($item->content_en) }}       
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              <section id="blog-pagination" class="blog-pagination section">
                <div class="container">
                  <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                  </div>
                </div>
              </section>
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