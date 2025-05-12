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