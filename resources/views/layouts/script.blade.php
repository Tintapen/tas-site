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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('my-modal'));

    document.querySelectorAll('.open-modal').forEach(item => {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        
        const stores = JSON.parse(this.dataset.stores || '[]');
        const storeList = document.getElementById('store-list');
        const logo = this.dataset.logo;
        storeList.innerHTML = '';

        if (stores.length > 0) {
            stores.forEach(store => {
                storeList.innerHTML += `
                    <div class="col text-center mb-3">
                        <figure class="figure">
                            <a href="${store.url ?? '#'}" target="_blank">
                                <img class="figure-img img-fluid mb-0" src="${logo}">
                            </a>
                            <figcaption class="figure-caption text-center">${store.name}</figcaption>
                        </figure>
                    </div>
                `;
            });
        } else {
          storeList.innerHTML = `<p class="text-center">No store available.</p>`;
        }

        modal.show();
      });
    });
  });
</script>