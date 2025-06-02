<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <h4 class="sitename">{{ $setting->name }}</h4>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">{{ __('Menu.MN1') }}</a></li>
        
            <li class="dropdown">
              <a href="#" class="{{ Request::is('about-us') || Request::is('career*') ? 'active' : '' }}">
                <span>{{ __('Menu.MN2') }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
              </a>
              <ul>
                <li><a href="{{ url('/about-us') }}" class="{{ Request::is('about-us') ? 'active' : '' }}">{{ __('Menu.MN3') }}</a></li>
                <li><a href="{{ url('/career') }}" class="{{ Request::is('career*') ? 'active' : '' }}">{{ __('Menu.MN4') }}</a></li>
              </ul>
            </li>
        
            <li><a href="{{ url('/product') }}" class="{{ Request::is('product*') ? 'active' : '' }}">{{ __('Menu.MN5') }}</a></li>
        
            <li class="dropdown">
              <a href="#" class="{{ Request::is('news*') || Request::is('gallery') ? 'active' : '' }}">
                <span>{{ __('Menu.MN6') }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
              </a>
              <ul>
                <li><a href="{{ url('/news') }}" class="{{ Request::is('news*') ? 'active' : '' }}">{{ __('Menu.MN7') }}</a></li>
                <li><a href="{{ url('/gallery') }}" class="{{ Request::is('gallery') ? 'active' : '' }}">{{ __('Menu.MN8') }}</a></li>
              </ul>
            </li>
        
            <li><a href="{{ url('/contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">{{ __('Menu.MN9') }}</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>        
  
        <a href="/lang/id" class="cta-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}" >ind</a>
        <a  href="/lang/en" class="cta-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" style="margin-left: -17px;">eng</a>
  
    </div>
</header>