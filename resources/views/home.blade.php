@extends('layouts.member.master')

@section('content')
    <!-- Menampilkan pesan error -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Ada Kesalahan:</h4>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Menampilkan pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <h4 class="alert-heading"><i class="fas fa-check-circle"></i> Berhasil!</h4>
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel mb-5">
        @if ($sliders->isEmpty())
            <!-- Default Slider if no data -->
            <div class="header-carousel-item">
                <img src="{{ asset('assets/img/MAS00029.jpg') }}" class="img-fluid"
                    style="width: 100%; height: 60%; margin: 0 auto;" alt="Default Image">
                <div class="carousel-caption"
                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <div class="carousel-caption-content p-3 text-center">
                        <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 2px;">
                            {{ __('messages.company_name') }}
                        </h5>
                        <h1 class="display-1 text-capitalize text-white mb-4">
                            {{ __('messages.tagline') }}
                        </h1>
                        <p class="mb-5 fs-5">{{ __('messages.description') }}</p>
                        <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="{{ route('about') }}">
                            {{ __('messages.about_us') }}
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Loop through sliders if data exists -->
            @foreach ($sliders as $slider)
                <div class="header-carousel-item">
                    <img src="{{ asset($slider->image_url) }}" class="img-fluid"
                        style="width: 100%; height: 60%; margin: 0 auto;" alt="Image">
                    <div class="carousel-caption"
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        <div class="carousel-caption-content p-3 text-center">
                            <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 2px;">
                                {{ $slider->subtitle }}
                            </h5>
                            <h1 class="display-1 text-capitalize text-white mb-4">
                                {{ $slider->title }}
                            </h1>
                            <p class="mb-5 fs-5">{{ $slider->description }}</p>
                            <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="{{ $slider->button_url }}">
                                {{ $slider->button_text }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>



    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="text-secondary text-uppercase">{{ __('messages.about_us') }}</h5>
                    <h1 class="mb-4">{{ $compro->nama_perusahaan ?? 'PT Simplay Abyakta Mediatek' }}</h1>
                    <p class="mb-4" style="text-align: justify;">{{ $company->sejarah_singkat ?? ' ' }}</p>
                    <div class="col-6 text-center wow fadeInUp" data-wow-delay="0.2s">
                        <a class="btn btn-primary rounded-pill text-white py-3 px-5"
                            href="{{ route('about') }}">{{ __('messages.about_us') }}</a>
                    </div>
                </div>
                <div class="col-lg-6 pt-4" style="min-height: 500px;">
                    <div class="position-relative h-100 wow fadeInUp" data-wow-delay="0.5s">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets/img/building.jpeg') }}"
                            style="object-fit: cover; padding: 0 0 50px 100px;" alt="">
                        <img class="position-absolute start-0 bottom-0 img-fluid bg-white pt-2 pe-2 w-50 h-50"
                            src="{{ asset('assets/img/profil2.png') }}" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-fluid py-5 px-4 px-lg-0">
        <div class="row g-0">
            <div class="col-lg-2 d-none d-lg-flex">
                <div class="d-flex align-items-center justify-content-center bg-primary w-100 h-100"
                    style="border-top-right-radius: 100px; border-bottom-right-radius: 100px; overflow: hidden;">
                    <img src="{{ asset('assets/img/Logo2.png') }}" alt="SIMPLAY Logo" class="img-fluid">
                </div>
            </div>
            <div class="col-md-12 col-lg-10">
                <div class="ms-lg-5 ps-lg-5">
                    <div class="text-center text-lg-start wow fadeInUp" data-wow-delay="0.1s">
                        <h6 class="text-secondary text-uppercase">{{ __('messages.tujuan_kami') }}</h6>
                        <h1 class="mb-5">{{ __('messages.visi_misi_perusahaan') }}</h1>
                    </div>
                    <div class="owl-carousel service-carousel position-relative wow fadeInUp" style="text-align: justify;"
                        data-wow-delay="0.1s">
                        <div class="bg-light p-4"
                            style="display: flex; flex-direction: column; justify-content: space-between; height: 300px;">
                            <div class="d-flex align-items-center justify-content-center border border-5 border-white mb-4"
                                style="width: 75px; height: 75px;">
                                <i class="fa fa-handshake fa-2x text-primary"></i>
                            </div>
                            <h5 class="mb-3">{{ __('messages.pelayanan') }}</h5>
                            <p>{{ __('messages.pelayanan_desc') }}</p>
                        </div>
                        <div class="bg-light p-4"
                            style="display: flex; flex-direction: column; justify-content: space-between; height: 300px;">
                            <div class="d-flex align-items-center justify-content-center border border-5 border-white mb-4"
                                style="width: 75px; height: 75px;">
                                <i class="fa fa-check-circle fa-2x text-primary"></i>
                            </div>
                            <h5 class="mb-3">{{ __('messages.kualitas') }}</h5>
                            <p>{{ __('messages.kualitas_desc') }}</p>
                        </div>
                        <div class="bg-light p-4"
                            style="display: flex; flex-direction: column; justify-content: space-between; height: 300px;">
                            <div class="d-flex align-items-center justify-content-center border border-5 border-white mb-4"
                                style="width: 75px; height: 75px;">
                                <i class="fa fa-star fa-2x text-primary"></i>
                            </div>
                            <h5 class="mb-3">{{ __('messages.kepuasan') }}</h5>
                            <p>{{ __('messages.kepuasan_desc') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Product Start -->
    @if (!$produks->isEmpty())
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase">{{ __('messages.find_products') }}</h6>
                    <h1 class="mb-5">{{ __('messages.our_products') }}</h1>
                </div>
                <div class="row g-4">
                    @foreach ($produks as $produk)
                        <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                            <!-- Card is now wrapped in a link -->
                            <a href="{{ route('product.show', $produk->id) }}" style="text-decoration: none;">
                                <div class="blog-item rounded"
                                    style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); padding: 20px; height: 250px; border-radius: 15px; display: flex; flex-direction: column; justify-content: space-between;">
                                    <div class="blog-img"
                                        style="overflow: hidden; border-radius: 15px; position: relative; flex: 1;">
                                        <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                            class="img-fluid w-100"
                                            style="border-radius: 15px; width: 100%; height: 150px; object-fit: cover; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                            alt="{{ $produk->nama }}"
                                            onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0px 4px 15px rgba(0, 0, 0, 0.2)';"
                                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                    </div>
                                    <h5
                                        style="font-weight: bold; color: #343a40; font-size: 1rem; margin: 0; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {{ $produk->nama }}
                                        <span class="arrow"
                                            style="display: inline-block; font-size: 1.5rem; color: #007BFF; transition: transform 0.3s ease;"
                                            onmouseover="this.textContent='—>'" onmouseout="this.textContent='→'">→</span>
                                    </h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                        <a class="btn btn-primary rounded-pill text-white py-3 px-5"
                            href="{{ route('product.index') }}">{{ __('messages.see_more') }}</a>
                    </div>
                </div>
            </div>
        </div><br>
    @endif
    <!-- Product End -->

    <!-- Brand Start -->
    @if ($principals->isNotEmpty())
        <div id="brand" class="container-xxl py-5" data-wow-delay="0.1s">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase">{{ __('messages.our_brand') }}</h6>
                    <h1 class="mb-5">{{ __('messages.brands_product') }}</h1>
                </div>
                <div class="row gy-4">
                    @foreach ($principals as $key => $p)
                        <div class="col-6 col-md-4 col-xl-2 text-center principal-item {{ $key >= 10 ? 'd-none' : '' }}">
                            <div class="bg-white px-4 py-3 px-md-6 py-md-4 px-lg-8 py-lg-5">
                                <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->name }}"
                                    width="100%" height="45">
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($principals->count() > 8)
                    <div class="text-center mt-4">
                        <button id="show-more-principals" class="btn btn-primary"
                            style="border-radius: 30px;">{{ __('messages.show_more') }}</button>
                        <button id="show-less-principals" class="btn btn-secondary d-none"
                            style="border-radius: 30px;">{{ __('messages.show_less') }}</button>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <!-- Brand End -->

    <script>
        document.getElementById('show-more-partners').addEventListener('click', function() {
            document.querySelectorAll('.partner-item.d-none').forEach(function(item) {
                item.classList.remove('d-none');
            });
            this.style.display = 'none';
            document.getElementById('show-less-partners').classList.remove('d-none');
        });

        document.getElementById('show-less-partners').addEventListener('click', function() {
            document.querySelectorAll('.partner-item').forEach(function(item, index) {
                if (index >= 8) {
                    item.classList.add('d-none');
                }
            });
            this.classList.add('d-none');
            document.getElementById('show-more-partners').style.display = 'inline-block';
        });

        document.getElementById('show-more-principals').addEventListener('click', function() {
            document.querySelectorAll('.principal-item.d-none').forEach(function(item) {
                item.classList.remove('d-none');
            });
            this.style.display = 'none';
            document.getElementById('show-less-principals').classList.remove('d-none');
        });

        document.getElementById('show-less-principals').addEventListener('click', function() {
            document.querySelectorAll('.principal-item').forEach(function(item, index) {
                if (index >= 10) {
                    item.classList.add('d-none');
                }
            });
            this.classList.add('d-none');
            document.getElementById('show-more-principals').style.display = 'inline-block';
        });
    </script>
@endsection
