<body>

    @php
        // Fetch the first record from the compro_parameter table
        $compro = \App\Models\CompanyParameter::first();
    @endphp

    {{-- <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End --> --}}


    <!-- Topbar Start -->
    <div class="container-fluid bg-light d-none d-lg-block">
        <div class="row align-items-center top-bar">
            <div class="col-lg-3 col-md-12 text-center text-lg-start">
                <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center m-0 p-0">
                    <img src="{{ asset('assets/img/Logo.png') }}" alt="SIMPLAY Logo" class="img-fluid" style="width: 50%;">
                    <img src="{{ asset('assets/img/catalogue.png') }}" alt="Logo" class="me-2"
                    style="height: auto; width: 150px; padding-left: 10px;">
                </a>
            </div>
            <div class="col-lg-9 col-md-12 text-end">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <!-- Maps / Office Location -->
                    @if (!empty($compro->maps))
                        <a href="{{ $compro->maps }}" class="text-gray me-4" target="_blank">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>Lokasi Kantor
                        </a>
                    @else
                        <p class="text-gray me-4">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>Office Location Not Available
                        </p>
                    @endif
                </div>
                <div class="h-100 d-inline-flex align-items-center me-4">
                    @if (!empty($compro->email))
                        <a href="mailto:{{ $compro->email }}" class="text-gray me-0">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            {{ $compro->email }}
                        </a>
                    @else
                        <p class="text-gray me-0">
                            <i class="fas fa-envelope text-primary me-2"></i>Email Not Available
                        </p>
                    @endif
                </div>
                <div class="h-100 d-inline-flex align-items-center me-4">
                    @if (!empty($compro->no_telepon))
                        <a href="tel:+62{{ $compro->no_telepon }}" class="text-gray me-4">
                            <i class="fas fa-phone-alt text-primary me-2"></i>
                            {{ $compro->no_telepon }}
                        </a>
                    @else
                        <p class="text-gray me-4">
                            <i class="fas fa-phone-alt text-primary me-2"></i>Phone Number Not Available
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    @php
        $activeMetas = \App\Models\Meta::where('start_date', '<=', today())
            ->where('end_date', '>=', today())
            ->get()
            ->groupBy('type');

        $brand = \App\Models\BrandPartner::where('type', 'brand', 'nama')->get();

    @endphp

    <!-- Navbar Start -->
    <div class="container-fluid nav-bar bg-light">
        <nav class="navbar navbar-expand-lg navbar-light bg-white p-3 py-lg-0 px-lg-4">
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center m-0 p-0 d-lg-none">
                <img src="{{ asset('assets/img/Logo.png') }}" alt="SIMPLAY Logo" class="img-fluid"
                    style="max-width: 100px;">
                    <img src="{{ asset('assets/img/catalogue.png') }}" alt="Logo" class="me-2"
                    style="height: auto; width: 150px; padding-left: 15px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto">
                    <a href="{{ route('home') }}" class="nav-item nav-link">{{ __('messages.home') }}</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link">{{ __('messages.about') }}</a>
                    <a href="{{ route('activity') }}" class="nav-item nav-link">{{ __('messages.activity') }}</a>
                    <a href="{{ route('product.index') }}" class="nav-item nav-link">{{ __('messages.products') }}</a>
                    @foreach ($activeMetas as $type => $metas)
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown-{{ $type }}"
                                aria-expanded="false" data-bs-toggle="dropdown">{{ ucfirst($type) }}</a>
                            <div class="dropdown-menu m-0" aria-labelledby="navbarDropdown-{{ $type }}">
                                @foreach ($metas as $meta)
                                    <a href="{{ route('member.meta.show', $meta->slug) }}"
                                        class="dropdown-item">{{ $meta->title }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    @auth
                        <a href="{{ route('portal') }}" class="nav-item nav-link">{{ __('messages.portal_member') }}</a>
                    @endauth

                    <a href="{{ route('contact') }}" class="nav-item nav-link">{{ __('messages.contact') }}</a>

                    <!-- Dropdown for language selection -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            @if (LaravelLocalization::getCurrentLocale() == 'id')
                                <img src="{{ asset('assets/kai/assets/img/flags/id.png') }}" alt="Bahasa Indonesia" style="width: 25px; height: auto; margin-right: 5px;">
                            @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                                <img src="{{ asset('assets/kai/assets/img/flags/us.png') }}" alt="English" style="width: 25px; height: auto; margin-right: 5px;">
                            @else
                                {{ LaravelLocalization::getCurrentLocaleNative() }}
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end m-0">
                            <a href="{{ LaravelLocalization::getLocalizedURL('id') }}" class="dropdown-item">
                                <img src="{{ asset('assets/kai/assets/img/flags/id.png') }}" alt="Bahasa Indonesia" style="width: 25px; height: auto; margin-right: 5px;">
                                {{ __('messages.bahasa') }}
                            </a>
                            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="dropdown-item">
                                <img src="{{ asset('assets/kai/assets/img/flags/us.png') }}" alt="English" style="width: 25px; height: auto; margin-right: 5px;">
                                {{ __('messages.english') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mt-lg-0 me-lg-n4 py-3 px-4 bg-primary d-flex align-items-center">
                    @if (auth()->check())
                        <div class="dropdown text-light">
                            <a href="#" class="dropdown-toggle text-light" id="companyDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <small class="text-light"><i
                                        class="fa fa-user text-light text-primary me-2"></i>{{ auth()->user()->nama_perusahaan }}</small>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="companyDropdown">
                                <!-- Show Profile -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fa fa-user me-2"></i>Profil
                                    </a>
                                </li>

                                <!-- Logout -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt me-2"></i>Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}"><small
                                class="btn btn-primary rounded-pill text-white py-1 px-1"><i
                                    class="fa fa-sign-in-alt text-white me-2"></i>Masuk Member</small></a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <style>
        .navbar-nav .nav-link.active {
            color: #6196FF !important;
            border-bottom: 2px solid #6196FF;
            /* Garis bawah */
            padding-bottom: 5px;
            /* Ruang antara teks dan garis */
        }

        .navbar-nav .nav-link:hover {
            border-bottom: 2px solid #6196FF;
            /* Garis bawah saat hover */
            padding-bottom: 5px;
            /* Ruang antara teks dan garis */
        }

        .nav-item .dropdown-item.active {
            color: #6196FF !important;
            font-weight: bold;
        }

        .nav-item .dropdown-toggle.active {
            color: #6196FF !important;
            border-bottom: 2px solid #6196FF;
        }
    </style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.navbar-nav .nav-link');
        const metaDropdownItems = document.querySelectorAll('.dropdown-item'); // Hanya targetkan .dropdown-item dalam meta
        const currentUrl = window.location.href;

        // Set the active link on page load
        function setActiveLink() {
            let foundActive = false;

            // Untuk semua .nav-link
            links.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('active');
                    foundActive = true;
                } else {
                    link.classList.remove('active');
                }
            });

            // Jika tidak ada yang aktif, bisa aktifkan link pertama (opsional)
            if (!foundActive && links.length > 0) {
                links[0].classList.add('active');
            }
        }

        // Event listener untuk dropdown meta items (hanya untuk link di dalam meta)
        metaDropdownItems.forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault(); // Hentikan navigasi default

                // Hapus kelas 'active' dari semua nav-link di dropdown meta
                links.forEach(link => link.classList.remove('active'));

                // Tambahkan kelas 'active' ke nav-link tipe meta yang relevan
                const dropdownType = this.closest('.dropdown').querySelector('.nav-link');
                dropdownType.classList.add('active');

                // Lakukan redirect ke URL yang diklik setelah penundaan kecil
                setTimeout(() => {
                    window.location.href = this.href;
                }, 100);
            });
        });

        // On click, set the clicked nav-link as active
        links.forEach(link => {
            link.addEventListener('click', function() {
                links.forEach(link => link.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Initial check on page load
        setActiveLink();
    });
</script>
