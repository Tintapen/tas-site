<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Career</title>
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
           <!-- <div class="breadcrumbs-inner bread-">  -->
               <div class="row">
               
                   <div class="col-lg-8 col-md-7">                                          
                           <h2>
                               Career
                             </h2>             
                               
                   </div>
                   <div class="col-lg-4 col-md-5 text-md-right">
                                       </div>
               </div>
           <!-- </div> -->
         </div>
     </div>
   <!-- End Page Title -->
 
       <!-- Blog Posts Section -->
       <section class="explore-section section-padding" id="section_2">
         <div class="container">
 
                 <div class="col-12 text-center">
                     <h2 class="mb-4">Karir</h1>
                 </div>
 
             </div>
         </div>
 
         <div class="container-fluid">
             <div class="row">
                 <ul class="nav nav-tabs" id="myTab" role="tablist">
                     <li class="nav-item" role="presentation">
                         <button class="nav-link active" id="design-tab" data-bs-toggle="tab" data-bs-target="#design-tab-pane" type="button" role="tab" aria-controls="design-tab-pane" aria-selected="true">IT</button>
                     </li>
 
                     <li class="nav-item" role="presentation">
                         <button class="nav-link" id="marketing-tab" data-bs-toggle="tab" data-bs-target="#marketing-tab-pane" type="button" role="tab" aria-controls="marketing-tab-pane" aria-selected="false">Marketing</button>
                     </li>
 
                     <li class="nav-item" role="presentation">
                         <button class="nav-link" id="finance-tab" data-bs-toggle="tab" data-bs-target="#finance-tab-pane" type="button" role="tab" aria-controls="finance-tab-pane" aria-selected="false">Finance</button>
                     </li>
 
                 </ul>
             </div>
         </div>
 
         <div class="container">
             <div class="row">
 
                 <div class="col-12">
                     <div class="tab-content" id="myTabContent">
                         <div class="tab-pane fade show active" id="design-tab-pane" role="tabpanel" aria-labelledby="design-tab" tabindex="0">
                             <div class="row">
                               <div class="col-lg-6 col-md-6 col-12">
                                 <div class="custom-block custom-block-overlay">
                                     <div class="d-flex flex-column h-100">
                                         <img src="images/businesswoman-using-tablet-analysis-graph-company-finance-strategy-statistics-success-concept-planning-future-office-room.jpg" class="custom-block-image img-fluid" alt="">
     
                                         <div class="custom-block-overlay-text d-flex">
                                             <div>
                                                 <h5 class="text-white mb-2">IT</h5>
     
                                                 <p class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint animi necessitatibus aperiam repudiandae nam omnis</p>
     
                                                 <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3">Learn More</a>
                                             </div>
     
                                             
                                         </div>
     
                                         
     
                                         <div class="section-overlay"></div>
                                     </div>
                                 </div>
                             </div>
 
                             <div class="col-lg-6 col-md-6 col-12">
                               <div class="custom-block custom-block-overlay">
                                   <div class="d-flex flex-column h-100">
                                       <img src="images/businesswoman-using-tablet-analysis-graph-company-finance-strategy-statistics-success-concept-planning-future-office-room.jpg" class="custom-block-image img-fluid" alt="">
   
                                       <div class="custom-block-overlay-text d-flex">
                                           <div>
                                               <h5 class="text-white mb-2">IT</h5>
   
                                               <p class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint animi necessitatibus aperiam repudiandae nam omnis</p>
   
                                               <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3">Learn More</a>
                                           </div>
   
                                           
                                       </div>
   
                                       
   
                                       <div class="section-overlay"></div>
                                   </div>
                               </div>
                           </div>
 
                                 
                             </div>
                         </div>
 
                         <div class="tab-pane fade" id="marketing-tab-pane" role="tabpanel" aria-labelledby="marketing-tab" tabindex="0">
                             <div class="row">
                               <div class="col-lg-6 col-md-6 col-12">
                                 <div class="custom-block custom-block-overlay">
                                     <div class="d-flex flex-column h-100">
                                         <img src="images/businesswoman-using-tablet-analysis-graph-company-finance-strategy-statistics-success-concept-planning-future-office-room.jpg" class="custom-block-image img-fluid" alt="">
     
                                         <div class="custom-block-overlay-text d-flex">
                                             <div>
                                                 <h5 class="text-white mb-2">Marketing</h5>
     
                                                 <p class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint animi necessitatibus aperiam repudiandae nam omnis</p>
     
                                                 <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3">Learn More</a>
                                             </div>
     
                                             
                                         </div>
     
                                         
     
                                         <div class="section-overlay"></div>
                                     </div>
                                 </div>
                             </div>
 
                             <div class="col-lg-6 col-md-6 col-12">
                               <div class="custom-block custom-block-overlay">
                                   <div class="d-flex flex-column h-100">
                                       <img src="images/businesswoman-using-tablet-analysis-graph-company-finance-strategy-statistics-success-concept-planning-future-office-room.jpg" class="custom-block-image img-fluid" alt="">
   
                                       <div class="custom-block-overlay-text d-flex">
                                           <div>
                                               <h5 class="text-white mb-2">Marketing</h5>
   
                                               <p class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint animi necessitatibus aperiam repudiandae nam omnis</p>
   
                                               <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3">Learn More</a>
                                           </div>
   
                                           
                                       </div>
   
                                       
   
                                       <div class="section-overlay"></div>
                                   </div>
                               </div>
                           </div>
 
                                    
                                 </div>
                           </div>
 
                         <div class="tab-pane fade" id="finance-tab-pane" role="tabpanel" aria-labelledby="finance-tab" tabindex="0">   <div class="row">
                           <div class="col-lg-6 col-md-6 col-12">
                             <div class="custom-block custom-block-overlay">
                                 <div class="d-flex flex-column h-100">
                                     <img src="images/businesswoman-using-tablet-analysis-graph-company-finance-strategy-statistics-success-concept-planning-future-office-room.jpg" class="custom-block-image img-fluid" alt="">
 
                                     <div class="custom-block-overlay-text d-flex">
                                         <div>
                                             <h5 class="text-white mb-2">Finance</h5>
 
                                             <p class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint animi necessitatibus aperiam repudiandae nam omnis</p>
 
                                             <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3">Learn More</a>
                                         </div>
 
                                         
                                     </div>
 
                                     
 
                                     <div class="section-overlay"></div>
                                 </div>
                             </div>
                         </div>
 
                                 <div class="col-lg-6 col-md-6 col-12">
                                     <div class="custom-block custom-block-overlay">
                                         <div class="d-flex flex-column h-100">
                                             <img src="images/businesswoman-using-tablet-analysis-graph-company-finance-strategy-statistics-success-concept-planning-future-office-room.jpg" class="custom-block-image img-fluid" alt="">
 
                                             <div class="custom-block-overlay-text d-flex">
                                                 <div>
                                                     <h5 class="text-white mb-2">Finance</h5>
 
                                                     <p class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint animi necessitatibus aperiam repudiandae nam omnis</p>
 
                                                     <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3">Learn More</a>
                                                 </div>
 
                                             </div>
 
                                             
 
                                             <div class="section-overlay"></div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
 
                         
 
                         
                     </div>
 
             </div>
         </div>
     </section>
     <!-- /Blog Pagination Section -->
 
     
 
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