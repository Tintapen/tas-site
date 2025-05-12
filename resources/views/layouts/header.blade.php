<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <img src="{{ $logo }}" alt="Logo" class="img-fluid" style="max-height: 50px;">
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
        
            <li class="dropdown">
              <a href="#" class="{{ Request::is('about-us') || Request::is('career') ? 'active' : '' }}">
                <span>Company</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
              </a>
              <ul>
                <li><a href="{{ url('/about-us') }}" class="{{ Request::is('about-us') ? 'active' : '' }}">About Us</a></li>
                <li><a href="{{ url('/career') }}" class="{{ Request::is('career') ? 'active' : '' }}">Career</a></li>
              </ul>
            </li>
        
            <li><a href="{{ url('/product') }}" class="{{ Request::is('product') ? 'active' : '' }}">Product</a></li>
        
            <li class="dropdown">
              <a href="#" class="{{ Request::is('news') || Request::is('gallery') ? 'active' : '' }}">
                <span>Media</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
              </a>
              <ul>
                <li><a href="{{ url('/news') }}" class="{{ Request::is('news') ? 'active' : '' }}">News</a></li>
                <li><a href="{{ url('/gallery') }}" class="{{ Request::is('gallery') ? 'active' : '' }}">Gallery</a></li>
              </ul>
            </li>
        
            <li><a href="{{ url('/contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>        
  
        <a href="/lang/id" class="cta-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}" >ind</a>
        <a  href="/lang/en" class="cta-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" style="margin-left: -17px;">eng</a>
  
    </div>
</header>