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
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="dropdown">
                <a href="#" class="active"><span>Company</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
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

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
     <div class="container  position-relative">
               <div class="row">
               
                   <div class="col-lg-8 col-md-7">                                          
                           <h2>
                            {{ __('About.HH1') }}
                             </h2>             
                               
                   </div>
                   <div class="col-lg-4 col-md-5 text-md-right"></div>
               </div>
         </div>
     </div>





<!-- Features Section -->
<section id="features" class="features section">
 <div class="container">

   <ul class="nav nav-tabs row  d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
     <li class="nav-item col-5" >
       <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
         <i class="bi bi-lightbulb"></i>
         {{-- <i class="bi bi-lightbulb-fill"></i> --}}
         <h4 class="d-none d-lg-block">{{ __('About.HH2') }}</h4>
       </a>
     </li>
     <li class="nav-item col-5">
       <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
         <i class="bi bi-bullseye"></i>
         <h4 class="d-none d-lg-block">{{ __('About.HH3') }}</h4>
       </a>
     </li>
   </ul><!-- End Tab Nav -->

   <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

     <div class="tab-pane fade active show" id="features-tab-1">
       <div class="row">
         <div class="col-lg-5 order-2 order-lg-1 mt-3 mt-lg-0 align-self-center" >
           <h1>{{ __('About.HH2') }}</h1>

           <p style="font-size: 24px;">
            {{ __('About.HP1') }}
           </p>
         </div>
         <div class="col-lg-6 order-1 order-lg-2 text-center">
           <img src="{{ asset('template/img/working-1.jpg') }}" alt="" class="img-fluid">
         </div>
       </div>
     </div><!-- End Tab Content Item -->

     <div class="tab-pane fade" id="features-tab-2">
       <div class="row">
         <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 align-self-center">
           <h1>{{ __('About.HH3') }}</h1>

           <ul>
             <li><i class="bi bi-bullseye"></i> <span style="font-size: 24px;">{{ __('About.HS1') }}</span></li>
             <li><i class="bi bi-bullseye"></i> <span style="font-size: 24px;">{{ __('About.HS2') }}</span></li>
             <li><i class="bi bi-bullseye"></i> <span style="font-size: 24px;">{{ __('About.HS3') }}</span></li>
             <li><i class="bi bi-bullseye"></i> <span style="font-size: 24px;">{{ __('About.HS4') }}</span></li>
           </ul>
         </div>
         <div class="col-lg-6 order-1 order-lg-2 text-center">
           <img src="{{ asset('template/img/working-2.jpg') }}" alt="" class="img-fluid">
         </div>
       </div>
     </div><!-- End Tab Content Item -->

   </div>

 </div>

</section><!-- /Features Section -->


<!-- start milestone -->
<section class="bsb-timeline-3 bg-light py-3 py-md-5 py-xl-8">
 <!-- Section Title -->
 <div class="container section-title" data-aos="fade-up">
  <h2>{{ __('About.HH4') }}</h2>
  <p>{{ __('About.HP2') }}</p>
</div>
<!-- End Section Title -->
<div class="wrap">
 <div class="col col1"></div>
 <div class="col col2">
   <div class="circle circle1">
     <h2><span><b></b> <i>1999</i></span></h2>
     <div class="shim shim1"></div>
   </div>
   <div class="content">
     <h3>Agm - 41 days</h3>
   </div>
 </div>
 <div class="col col1">
   <div class="circle circle2">
     <h2><span><b></b> <i>1999</i></span></h2>
     <div class="shim shimx shim2"></div>
   </div>
   <div class="content">
     <h3>Agm - 42 days</h3>
   </div>
 </div>
 <div class="col col2"></div>
 <div class="col col1"></div>
 <div class="col col2">
   <div class="circle circle3">
     <h2><span><b></b> <i>1999</i></span></h2>
     <div class="shim shim3"></div>
   </div>
   <div class="content">
     <h3>Agm - 43 days</h3>
   </div>
 </div>
 <div class="col col1">
   <div class="circle circle4">
     <h2><span><b></b> <i>1999</i></span></h2>
     <div class="shim shimx shim4"></div>
   </div>
   <div class="content">
     <h3>Agm - 44 days</h3>
   </div>
 </div>
 <div class="col col2"></div>
 <div class="col col1"></div>
 <div class="col col2">
   <div class="circle circle5">
     <h2><span><b></b> <i>1999</i></span></h2>
     <div class="shim shim5"></div>
   </div>
   <div class="content">
     <h3>Agm - 40 days</h3>
   </div>
 </div>
 <div class="col col1">
   <div class="circle circle6">
     <h2><span><b></b> <i>1999</i></span></h2>
     <div class="shim shimx shim6"></div>
   </div>
   <div class="content">
     <h3>Agm - 40 days</h3>
   </div>
 </div>
 <div class="col col2"></div>
 <div class="col col1"></div>
 <div class="col col2">
   <div class="circle circle7">
     <h2><span><b></b> <i>1999</i></span></h2>
     <div class="shim shim7"></div>
   </div>
   <div class="content">
     <h3>Agm - 40 days</h3>
   </div>
 </div>
 <div class="col col1">
   <div class="circle circle8">
     <h2><span><b></b> <i>1999</i></span></h2>
     <div class="shim shimx shim8"></div>
   </div>
   <div class="content">
     <h3>Agm - 40 days</h3>
   </div>
 </div>
 <div class="col col2"></div>

  {{-- @foreach ($mileStones as $milestone)
    <div class="col col{{ $loop->even ? '2' : '1' }}">
        <div class="circle circle{{ $loop->index + 1 }}">
            <h2>
                <span>
                    <b></b> <i>{{ date('Y', strtotime($milestone->milestone_date)) }}</i>
                </span>
            </h2>
            <div class="shim shim{{ $loop->index + 1 }}"></div>
        </div>
        <div class="content">
            <h3>{{ $milestone->description }} days</h3>
        </div>
    </div>
  @endforeach --}}
</div>
</section>
<!-- end milestone -->

    <!-- sertifikasi Section -->
    <section id="certificates" class="certificates section light-background">

     <!-- Section Title -->
     <div class="container section-title" data-aos="fade-up">
       <h2>{{ __('About.HH5') }}</h2>
       <p>{{ __('About.HP3') }}</p>
     </div><!-- End Section Title -->

     <div class="container" data-aos="fade-up" data-aos-delay="100">

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

            @foreach ($certificate as $ctf)
              <div class="swiper-slide">
                <div class="certificate-item">
                  <div class="profile mt-auto">
                    <img src="{{ asset('storage/' . $ctf->logo) }}" class="certificate-img" alt="">
                    <h3>{{ $ctf->name }}</h3>
                  </div>
                </div>
              </div><!-- End certificate item -->
            @endforeach
         </div>
         <div class="swiper-pagination"></div>
       </div>

     </div>

   </section>
   <!-- /certificates Section -->
   

       <!-- location Section -->
       <section id="certificates" class="certificates section">

         <!-- Section Title -->
         <div class="container section-title" data-aos="fade-up">
           <h2>>{{ __('About.HH6') }}</h2>
           <p>>{{ __('About.HP4') }}</p>
         </div><!-- End Section Title -->
   
        
   
           <div class="container pt-5 wow zoomIn" data-wow-delay="0.1s">
             <div class="rounded h-100">
                 <iframe class="rounded w-100" 
                 style="height: 500px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5325.4814161270115!2d106.8746948!3d-6.1316489999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1fd65e315457%3A0xae919023d8db827a!2sPT.%20Tri%20Anugerah%20Surya!5e1!3m2!1sen!2sid!4v1739891713558!5m2!1sen!2sid" 
                 loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                  
             </div>
         </div>
       </section>
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