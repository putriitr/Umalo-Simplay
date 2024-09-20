@extends('layouts.member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header mb-5 py-5"
        style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/about.jpg') }}') center center no-repeat; background-size: cover; height: 300px;">
        <div class="container">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('messages.about_us') }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">{{ __('messages.home') }}</a>
                    </li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{ __('messages.about_us') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="text-secondary text-uppercase">{{ __('messages.about_us') }}</h5>
                    <h1 class="mb-4">{{ $compro->nama_perusahaan ?? 'PT Simplay Abyakta Mediatek' }}</h1>
                    <p class="mb-4" style="text-align: justify;">{{ $company->sejarah_singkat ?? ' ' }}</p>
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

    <!-- Legality Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 wow fadeInUp text-center" data-wow-delay="0.1s">
                    <h5 class="text-secondary text-uppercase">{{ __('messages.legality_top') }}</h5>
                    <h1 class="mb-4">{{ __('messages.legality') }}</h1>
                </div>
                <div class="row g-12 justify-content-center d-flex">
                    <div class="col-md-12 col-lg-6 col-xl-6 d-flex" style="margin-bottom: 0.5rem;">
                        <div class="team-item rounded flex-fill"
                            style="display: flex; flex-direction: column; height: 100%; border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                            <div class="team-content text-center border border-primary border-top-0 rounded-bottom p-4"
                                style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                                <h5>{{ __('messages.legality_1') }}</h5>
                                <p class="mb-0" style="font-weight: bold;">{{ $company->visi ?? ' ' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-6 d-flex" style="margin-bottom: 0.5rem;">
                        <div class="team-item rounded flex-fill"
                            style="display: flex; flex-direction: column; height: 100%; border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                            <div class="team-content text-center border border-primary border-top-0 rounded-bottom p-4"
                                style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                                <h5>{{ __('messages.legality_2') }}</h5>
                                <p class="mb-0" style="font-weight: bold;">{{ $company->misi ?? ' ' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Legality End -->

    <!-- Brand Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">{{ __('messages.our_brand') }}</h6>
                <h1 class="mb-5">{{ __('messages.brands_product') }}</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-1.jpg" alt="">
                        </div>
                        <div class="team-text">
                            <div class="bg-light">
                                <h5 class="fw-bold mb-0">Full Name</h5>
                                <small>Designation</small>
                            </div>
                            <div class="bg-primary">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-2.jpg" alt="">
                        </div>
                        <div class="team-text">
                            <div class="bg-light">
                                <h5 class="fw-bold mb-0">Full Name</h5>
                                <small>Designation</small>
                            </div>
                            <div class="bg-primary">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-3.jpg" alt="">
                        </div>
                        <div class="team-text">
                            <div class="bg-light">
                                <h5 class="fw-bold mb-0">Full Name</h5>
                                <small>Designation</small>
                            </div>
                            <div class="bg-primary">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-4.jpg" alt="">
                        </div>
                        <div class="team-text">
                            <div class="bg-light">
                                <h5 class="fw-bold mb-0">Full Name</h5>
                                <small>Designation</small>
                            </div>
                            <div class="bg-primary">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand End -->

    <!-- Customer Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <section id="customer">
                <div class="row justify-content-center text-center mb-4">
                    <h1 class="mb-4">{{ __('messages.trusted_by') }}</h1>
                </div>
                <div class="carousel"
                    data-flickity='{ "wrapAround": true, "autoPlay": true, "pageDots": false, "prevNextButtons": true, "groupCells": true }'>
                    @foreach ($brands as $brand)
                        <div class="carousel-cell">
                            <img class="brand-logo" src="{{ asset('assets/img/brands/' . $brand->logo) }}" alt="{{ $brand->name }}">
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

    </div>
    <!-- Customer End -->
@endsection
