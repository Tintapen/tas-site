<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Home</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('template/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('template/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

   <!-- Customized Bootstrap Stylesheet -->
   <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">
   
  <!-- Main CSS File -->
  <link href="{{ asset('template/css/main.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://public.codepenassets.com/css/normalize-5.0.0.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>


</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">PT</h1>
        </a>

  
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="{{ url('/') }}" class="active">Home</a></li>
            <li class="dropdown">
                <a href="#"><span>Company</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="{{ url('/about-us') }}">About Us</a></li>
                    <li><a href="{{ url('/career') }}">Career</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/product') }}">Product</a></li>
            <li class="dropdown">
                <a href="#"><span>Media</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="{{ url('/news') }}">News</a></li>
                    <li><a href="{{ url('/gallery') }}">Gallery</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
  
        <a href="/lang/id" class="cta-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}" >ind</a>
        <a  href="/lang/en" class="cta-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" style="margin-left: -17px;">eng</a>
  
      </div>
  </header>

  <main class="main">

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
            <p>
                {{ __('Home.HP1') }}
            </p>

            @if (app()->getLocale() == 'id')
                <ul>
                    <li><i class="bi bi-check2-all"></i> <span>Produk-produk yang kami distribusikan adalah produk berkualitas tinggi sehingga dapat memberikan manfaat yang optimal bagi setiap penggunanya</span></li>
                    <li><i class="bi bi-check2-all"></i> <span>Jaminan kepuasan pelanggan adalah prioritas kami karena kepuasan Anda adalah kesuksesan kami.</span></li>
                </ul>
           @endif
         
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

  

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
              <div class="swiper-slide">
                <div class="service-item">
                  <div class="service-item-contents">
                    <a href="#">
                      <span class="service-item-category">Category</span>
                      <h2 class="service-item-title">Nama</h2>
                    </a>
                  </div>
                  <img src="assets/img/product/best-product-4.png" alt="Image" class="img-fluid">
                </div>
              </div>
              <div class="swiper-slide">
                <div class="service-item">
                  <div class="service-item-contents">
                    <a href="#">
                      <span class="service-item-category">Category</span>
                      <h2 class="service-item-title">nama</h2>
                    </a>
                  </div>
                  <img src="assets/img/product/best-product-4.png" alt="Image" class="img-fluid">
                </div>
              </div>
              <div class="swiper-slide">
                <div class="service-item">
                  <div class="service-item-contents">
                    <a href="#">
                      <span class="service-item-category">Category</span>
                      <h2 class="service-item-title">Nama</h2>
                    </a>
                  </div>
                  <img src="assets/img/product/best-product-4.png" alt="Image" class="img-fluid">
                </div>
              </div>

              <div class="swiper-slide">
                <div class="service-item">
                  <div class="service-item-contents">
                    <a href="#">
                      <span class="service-item-category">Category/span>
                      <h2 class="service-item-title">Nama</h2>
                    </a>
                  </div>
                  <img src="assets/img/product/best-product-4.png" alt="Image" class="img-fluid">
                </div>
              </div>
              <div class="swiper-slide">
                <div class="service-item">
                  <div class="service-item-contents">
                    <a href="#">
                      <span class="service-item-category">Category</span>
                      <h2 class="service-item-title">Nama</h2>
                    </a>
                  </div>
                  <img src="assets/img/product/best-product-4.png" alt="Image" class="img-fluid">
                </div>
              </div>
              
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

  </section><!-- /portos Section -->

  

   <!-- MP Section -->
   <section id="clients" class="clients section light-background">

    <div class="container" data-aos="fade-up">

      <div class="d-flex justify-content-center">

        
        <div class="col-xl-2 col-md-1 col-3 client-logo">
          <img src="{{ asset('template/img/tokped.png') }}" class="img-fluid" alt="" data-toggle="modal" data-target="#my-modal">
        </div><!-- End Client Item -->
      
        <div class="col-xl-2 col-md-3 col-3 client-logo">
          <img src="{{ asset('template/img/tokped.png') }}" class="img-fluid" alt="" data-toggle="modal" data-target="#my-modal">
        </div><!-- End Client Item -->

        <div class="col-xl-2 col-md-1 col-3 client-logo">
          <img src="{{ asset('template/img/tokped.png') }}" class="img-fluid" alt="" data-toggle="modal" data-target="#my-modal">
        </div><!-- End Client Item -->

      </div>

    </div>
  </section><!-- MP Section -->

  <div class="container d-flex justify-content-center">
        <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered justify-content-center " role="document">
                <div class="modal-content  border-0 mx-sm-3 mx-1">   
                    <div class="modal-body  p-0">
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="card">
                                      
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col"> <figure class="figure"><a href="www.google.com"><img class="figure-img img-fluid mb-0  " src="assets/img/tokped.png"></a><figcaption class="figure-caption text-center">Philip</figcaption></figure></div>
                                            <div class="col"> <figure class="figure"><a href="www.google.com"><img class="figure-img img-fluid mb-0  " src="assets/img/tokped.png"></a><figcaption class="figure-caption text-center">Michelin</figcaption></figure></div>
                                            <div class="col"> <figure class="figure"><a href="www.google.com"><img class="figure-img img-fluid mb-0  " src="assets/img/tokped.png"></a><figcaption class="figure-caption text-center">Lucas</figcaption></figure></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </main>

  <footer id="footer" class="footer dark-background"> 
    <div class="container copyright text-center mt-4">
      <div class="social-links d-flex mt-4">
        @foreach ($socialLinks as $link)
            <a href="{{ $link->url }}" target="_blank">
                <i class="bi bi-{{ $link->link }}"></i>
            </a>
        @endforeach
      </div>
      <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ date('Y') }}</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('template/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('template/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('template/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('template/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('template/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('template/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('template/js/main.js') }}"></script>

  <script src="{{ asset('template/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('template/js/popper.min.js') }}"></script>
  <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>

</body>

</html>