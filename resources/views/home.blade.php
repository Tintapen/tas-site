@extends('layouts.overview')

@section('title', $title)

@section('content')
  <!-- ***** Main Banner Area Start ***** -->
  <section class="hero" id="top" data-section="section1">
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <dotlottie-player id="bg-video" src="{{ asset('template/img/v6.json') }}" background="transparent" speed="1"  direction="1" playMode="normal" loop autoplay></dotlottie-player>
  </section>

  <!-- About Section -->
  <section id="about" class="about section">
    <div class="container">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <div class="position-relative col-lg-6 order-1 order-lg-2">
          <img src="{{ asset('template/img/about-2.jpg') }}" class="img-fluid rounded-4" alt="">
          <a href="https://youtu.be/8NK_k31j8L8" class="glightbox pulsating-play-btn"></a>
        </div>
        <div class="col-lg-6 order-2 order-lg-1 content">
          <h3>{{ __('Home.HH1') }}</h3>
          <p>{{ __('Home.HP1') }}</p>
          @if (app()->getLocale() == 'id')
            <ul>
                <li><i class="bi bi-check2-all"></i> <span>Produk-produk yang kami distribusikan adalah produk berkualitas tinggi sehingga dapat memberikan manfaat yang optimal bagi setiap penggunanya</span></li>
                <li><i class="bi bi-check2-all"></i> <span>Jaminan kepuasan pelanggan adalah prioritas kami karena kepuasan Anda adalah kesuksesan kami.</span></li>
            </ul>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- Product Section -->
  <section id="product" class="product section blue-background">
    <!-- Section Title -->
    <div class="container section-title product-title" data-aos="fade-up">
      <h2>{{ __('Home.HH2') }}</h2>
      <p>{{ __('Home.HP2') }}</p>
    </div>

    <div class="products-carousel-wrap">
      <div class="container">
        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "navigation": {
                "nextEl": ".js-custom-next",
                "prevEl": ".js-custom-prev"
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 40
                }
              }
            }
          </script>
          <button class="navigation-prev js-custom-prev">
            <i class="bi bi-arrow-left-short"></i>
          </button>
          <button class="navigation-next js-custom-next">
            <i class="bi bi-arrow-right-short"></i>
          </button>
          <div class="swiper-wrapper">
            @foreach ($featuredProducts as $product)
              <div class="swiper-slide">
                <div class="service-item border rounded overflow-hidden shadow-sm h-100 d-flex flex-column bg-white">
                  <div class="service-item-image position-relative w-100" style="aspect-ratio: 4/3; overflow: hidden;">
                    <img src="{{ asset('storage/' . $product->logo) }}" alt="{{ $product->name }}" class="img-fluid w-100 h-100 object-fit-contain">
                  </div>

                  <div class="service-item-contents p-3 flex-grow-1 d-flex flex-column justify-content-center text-center">
                    <div class="d-block text-decoration-none">
                      <span class="badge bg-primary mb-2">
                        {{ $product->category->name ?? 'Uncategorized' }}
                      </span>
                      <h2 class="service-item-title">
                        {{ $product->name }}
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>          
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </section>

  <section id="portos" class="portos section">
    <div class="container section-title" data-aos="fade-up">
      <h2>{{ __('Home.HH3') }}</h2>
      <p>{{ __('Home.HP3') }}<br></p>
    </div>

    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "spaceBetween": 40
              },
              "1200": {
                "slidesPerView": 3,
                "spaceBetween": 1
              }
            }
          }
        </script>
        <div class="swiper-wrapper">
          
          <div class="swiper-slide porto-item d-flex flex-column justify-content-end overlay"  style="background-image: url(assets/img/testimonials-bg.jpg); background-size: cover; ">             
            <div class="portos-content h-100">              
              <div class="portos-info">
                <p>Lorem ipsum, dolor sit amet consectetur</p>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End porto item -->

          <div class="swiper-slide porto-item d-flex flex-column justify-content-end overlay"  style="background-image: url(assets/img/testimonials-bg.jpg); background-size: cover; ">             
            <div class="portos-content h-100">              
              <div class="portos-info">
                <p>Lorem ipsum, dolor sit amet consectetur</p>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End porto item -->

          <div class="swiper-slide porto-item d-flex flex-column justify-content-end overlay"  style="background-image: url(assets/img/testimonials-bg.jpg); background-size: cover; ">             
            <div class="portos-content h-100">              
              <div class="portos-info">
                <p>Lorem ipsum, dolor sit amet consectetur</p>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End porto item -->

          <div class="swiper-slide porto-item d-flex flex-column justify-content-end overlay"  style="background-image: url(assets/img/testimonials-bg.jpg); background-size: cover; ">             
            <div class="portos-content h-100">              
              <div class="portos-info">
                <p>Lorem ipsum, dolor sit amet consectetur</p>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>
  <!-- /portos Section -->

  <!-- MP Section -->
  <section id="clients" class="clients section light-background">
    <div class="container" data-aos="fade-up">
      <div class="d-flex justify-content-center">
        @foreach ($marketPlaces as $mp)
          <div class="col-xl-2 col-md-1 col-3 client-logo">
            <a href="#" 
             class="open-modal" 
             data-id="{{ $mp->id }}" 
             data-name="{{ $mp->name }}"
             data-logo="{{ asset('storage/' . $mp->logo) }}"
             data-stores='@json($mp->stores)'>
              <img src="{{ asset('storage/' . $mp->logo) }}" class="img-fluid" alt="{{ $mp->name }}">
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- MP Section -->

  <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
      <div class="modal-content border-0 mx-sm-3 mx-1">   
        <div class="modal-body p-0">
          <div class="row justify-content-center">
            <div class="col">
              <div class="card">                                    
                <div class="card-body">
                  <div class="row" id="store-list">
                    <!-- Store list will be injected here -->
                  </div>                                      
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection