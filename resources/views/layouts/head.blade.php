<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'My Application')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
  
    <!-- Favicons -->
    <link href="{{ $faveicon }}" rel="icon">
  
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
    <link href="{{ asset('template/css/mile.css') }}" rel="stylesheet">

    <style>
        html, body {
          height: 100%;
          margin: 0;
        }
    
        body {
          display: flex;
          flex-direction: column;
          min-height: 100vh;
        }
    
        main {
          flex: 1;
        }
    
        footer {
          background: #f8f9fa;
          padding: 20px;
          text-align: center;
        }
    </style>
</head>