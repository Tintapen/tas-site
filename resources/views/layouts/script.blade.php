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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var applyModal = new bootstrap.Modal(document.getElementById('applyModal'));
        applyModal.show();
    });
</script>
@endif

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

document.addEventListener('DOMContentLoaded', function () {
    const loadMoreBtn = document.getElementById('load-more-btn');
    loadMoreBtn.addEventListener('click', function () {
        const offset = parseInt(this.getAttribute('data-offset'));

        fetch('{{ route("career.loadMore") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ offset })
        })
        .then(res => res.json())
        .then(data => {
            if (data.html) {
                document.getElementById('job-list').insertAdjacentHTML('beforeend', data.html);
                const newOffset = offset + data.count;
                loadMoreBtn.setAttribute('data-offset', newOffset);
                if (data.count < 5) {
                    loadMoreBtn.remove(); // habis
                }
            }
        })
        .catch(err => console.error(err));
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const filterForm = document.getElementById('filterForm');
    const hiddenCategory = document.getElementById('selectedCategory');

    const categories = [
        document.getElementById('categories1'),
        document.getElementById('categories2'),
        document.getElementById('categories3'),
        document.getElementById('categories4'),
        document.getElementById('categories5')
    ];

    const wrappers = [
        null,
        document.getElementById('wrapper2'),
        document.getElementById('wrapper3'),
        document.getElementById('wrapper4'),
        document.getElementById('wrapper5')
    ];

    function resetLevel(startIndex) {
        for (let i = startIndex; i < categories.length; i++) {
            categories[i].innerHTML = `<option value="">Pilih Kategori Level ${i + 1}</option>`;
            categories[i].disabled = true;
            wrappers[i] && (wrappers[i].style.display = 'none');
        }
    }

    function populateSelect(select, wrapper, children, selectedId = null) {
        const level = select.id.replace('categories', '');
        select.innerHTML = `<option value="">Pilih Kategori Level ${level}</option>`;
        
        if (children.length) {
            children.forEach(child => {
                const option = document.createElement('option');
                option.value = child.id;
                option.textContent = child.name;
                option.dataset.children = JSON.stringify(child.children_recursive || []);
                
                if (selectedId && child.id == selectedId) {
                    option.selected = true;
                }
                select.appendChild(option);
            });
            wrapper.style.display = 'block';
            select.disabled = false;
        }
    }

    categories.forEach((cat, idx) => {
        if (!cat) return;
        cat.addEventListener('change', function () {
            const children = JSON.parse(this.options[this.selectedIndex]?.dataset.children || '[]');
            resetLevel(idx + 1);
            if (categories[idx + 1]) {
                populateSelect(categories[idx + 1], wrappers[idx + 1], children);
            }
        });
    });

    filterButton.addEventListener('click', function () {
        let selectedName = '';
        for (let i = categories.length - 1; i >= 0; i--) {
            if (categories[i] && categories[i].value) {
                selectedName = categories[i].options[categories[i].selectedIndex].text;
                break;
            }
        }
        hiddenCategory.value = selectedName.trim();
        filterForm.submit();
    });

    // Preselect otomatis jika ada path dari server
    @if (count($categoryPath) > 1)
        @for ($i = 1; $i < count($categoryPath); $i++)
            setTimeout(function () {
                const prevSelect = categories[{{ $i - 1 }}];
                const children = JSON.parse(prevSelect.options[prevSelect.selectedIndex]?.dataset.children || '[]');
                populateSelect(categories[{{ $i }}], wrappers[{{ $i }}], children, {{ $categoryPath[$i]->id }});
            }, {{ $i * 300 }});
        @endfor
    @endif
});

document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const filterForm = document.getElementById('filterForm');
    const hiddenCategory = document.getElementById('selectedCategory');

    const categoryInputs = [
        document.getElementById('categories1'),
        document.getElementById('categories2'),
        document.getElementById('categories3'),
        document.getElementById('categories4'),
        document.getElementById('categories5')
    ];

    filterButton.addEventListener('click', function () {
        let selectedName = '';

        // Cari kategori terakhir yang dipilih, ambil text bukan value
        for (let i = categoryInputs.length - 1; i >= 0; i--) {
            if (categoryInputs[i] && categoryInputs[i].value) {
                selectedName = categoryInputs[i].options[categoryInputs[i].selectedIndex].text;
                break;
            }
        }

        hiddenCategory.value = selectedName.trim();
        filterForm.submit();
    });
});

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '{{ session('success') }}',
        });
    @elseif(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
        });
    @endif
</script>