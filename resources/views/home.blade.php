@extends('layouts.member.master')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('assets/img/bg3.jpeg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(0, 0, 0, .4);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Plumbing & Repairing
                                    Services</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">Efficient Residential Plumbing
                                    Services</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at
                                    sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                    More</a>
                                <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Free
                                    Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('assets/img/profil2.png') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(0, 0, 0, .4);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Plumbing & Repairing
                                    Services</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">Efficient Commercial Plumbing
                                    Services</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at
                                    sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                    More</a>
                                <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Free
                                    Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="text-secondary text-uppercase">{{ __('messages.about_us') }}</h5>
                    <h1 class="mb-4">{{ $compro->nama_perusahaan ?? 'PT Simplay Abyakta Mediatek' }}</h1>
                    <p class="mb-4" style="text-align: justify;">{{ $company->sejarah_singkat ?? ' ' }}</p>
                    {{-- <p class="fw-medium text-primary"><i class="fa fa-check text-success me-3"></i>Residential & commercial
                        plumbing</p>
                    <p class="fw-medium text-primary"><i class="fa fa-check text-success me-3"></i>Quality services at
                        affordable prices</p>
                    <p class="fw-medium text-primary"><i class="fa fa-check text-success me-3"></i>Immediate 24/ 7 emergency
                        services</p> --}}
                    <div class="bg-primary d-flex align-items-center p-3 mt-4">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white"
                            style="width: 60px; height: 60px;">
                            <i class="fab fa-whatsapp fa-2x text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <p class="fs-5 fw-medium mb-2 text-white">Emergency 24/7</p>
                            <h3 class="m-0 text-secondary">{{ $company->no_wa }}</h3>
                        </div>
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

    <!-- Fact Start -->
    <div class="container">
        <div class="row justify-content-center text-center mb-4">
            <h1 class="mb-4">{{ __('messages.our_brand') }}</h1>
        </div>
        <div class="carousel"
            data-flickity='{ "wrapAround": true, "autoPlay": false, "pageDots": false, "prevNextButtons": false }'>
            <!-- Ulangi div brand-cell ini sebanyak 53 kali untuk memasukkan gambar -->
            <div class="carousel-cell">
                <img class="carousel-image" src="{{ asset('assets/img/brands/brand (1).png') }}" alt="Brand 1">
            </div>
            <div class="carousel-cell">
                <img class="carousel-image" src="{{ asset('assets/img/brands/brand (2).png') }}" alt="Brand 2">
            </div>
            <div class="carousel-cell">
                <img class="carousel-image" src="{{ asset('assets/img/brands/brand (3).png') }}" alt="Brand 3">
            </div>
            <div class="carousel-cell">
                <img class="carousel-image" src="{{ asset('assets/img/brands/brand (4).png') }}" alt="Brand 4">
            </div>
            <div class="carousel-cell">
                <img class="carousel-image" src="{{ asset('assets/img/brands/brand (5).png') }}" alt="Brand 5">
            </div>
            <!-- Continue adding image cells up to 53 images -->
        </div>
        <div class="slider-container">
            <input type="range" min="0" max="52" value="0" class="slider" id="carouselSlider">
        </div>
    </div>
    <!-- Fact End -->

    <!-- Include Flickity JS -->
    <script src="{{ asset('assets/js/member/flickity.pkgd.min.js') }}"></script>
    <script>
        // Inisialisasi Flickity
        var flkty = new Flickity('.carousel', {
            wrapAround: true,
            autoPlay: false,
            pageDots: false,
            prevNextButtons: false
        });

        // Ambil elemen slider
        var rangeInput = document.getElementById('carouselSlider');

        // Event Listener untuk menggeser carousel saat slider digeser
        rangeInput.addEventListener('input', function() {
            flkty.select(rangeInput.value); // Sesuaikan gambar sesuai dengan nilai slider
        });

        // Update slider saat carousel digeser dengan manual atau otomatis
        flkty.on('change', function(index) {
            rangeInput.value = index; // Perbarui nilai slider sesuai gambar yang sedang aktif
        });
    </script>

    <style>
        .fact h1 {
            font-size: 24px;
            font-weight: bold;
            color: #2C2F8C;
        }

        .fact p {
            font-size: 16px;
            color: #7B7F8A;
        }

        /* Carousel container with limited width and centered on the page */
        .carousel {
            max-width: 80%;
            /* Set max width to 80% of the page */
            margin: 0 auto;
            /* Center the carousel on the page */
            background-color: #fff;
        }

        /* Each cell within the carousel */
        .carousel-cell {
            width: 200px;
            /* Adjust width for image container */
            height: 120px;
            /* Adjust height for image container */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            overflow: hidden;
            border-radius: 5px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            margin-right: 15px;
        }

        /* Styling for the images inside each cell */
        .carousel-image {
            max-width: 100px;
            /* Adjust the image width */
            max-height: 80px;
            /* Adjust the image height */
            object-fit: contain;
            /* Centers and resizes images while keeping proportions */
        }

        /* Styling untuk container slider */
        .slider-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        /* Kustomisasi input range */
        input[type=range].slider {
            -webkit-appearance: none;
            width: 80%;
            background: transparent;
        }

        /* Track slider (garis di belakang slider) */
        input[type=range].slider::-webkit-slider-runnable-track {
            width: 100%;
            height: 4px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }

        input[type=range].slider::-moz-range-track {
            width: 100%;
            height: 4px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }

        /* Thumb (lingkaran kecil untuk slider) */
        input[type=range].slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 12px;
            height: 12px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }

        input[type=range].slider::-moz-range-thumb {
            width: 12px;
            height: 12px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }
    </style>


    <!-- Service Start -->
    <div class="container-fluid py-5 px-4 px-lg-0">
        <div class="row g-0">
            <div class="col-lg-3 d-none d-lg-flex">
                <div class="d-flex align-items-center justify-content-center bg-primary w-100 h-100">
                    <h1 class="display-3 text-white m-0" style="transform: rotate(-90deg);">15 Years Experience</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-9">
                <div class="ms-lg-5 ps-lg-5">
                    <div class="text-center text-lg-start wow fadeInUp" data-wow-delay="0.1s">
                        <h6 class="text-secondary text-uppercase">{{ __('messages.tujuan_kami') }}</h6>
                        <h1 class="mb-5">{{ __('messages.visi_misi_perusahaan') }}</h1>
                    </div>
                    <div class="owl-carousel service-carousel position-relative wow fadeInUp" style="text-align: justify;"
                        data-wow-delay="0.1s">
                        <div class="bg-light p-4">
                            <div class="d-flex align-items-center justify-content-center border border-5 border-white mb-4"
                                style="width: 75px; height: 75px;">
                                <i class="fa fa-handshake fa-2x text-primary"></i>
                            </div>
                            <h4 class="mb-3">{{ __('messages.pelayanan') }}</h4>
                            <p>{{ __('messages.pelayanan_desc') }}</p>
                            {{-- <a href="" class="btn bg-white text-primary w-100 mt-2">Read More<i
                                    class="fa fa-arrow-right text-secondary ms-2"></i></a> --}}
                        </div>
                        <div class="bg-light p-4">
                            <div class="d-flex align-items-center justify-content-center border border-5 border-white mb-4"
                                style="width: 75px; height: 75px;">
                                <i class="fa fa-check-circle fa-2x text-primary"></i>
                            </div>
                            <h4 class="mb-3">{{ __('messages.kualitas') }}</h4>
                            <p>{{ __('messages.kualitas_desc') }}</p>
                            {{-- <a href="" class="btn bg-white text-primary w-100 mt-2">Read More<i
                                    class="fa fa-arrow-right text-secondary ms-2"></i></a> --}}
                        </div>
                        <div class="bg-light p-4">
                            <div class="d-flex align-items-center justify-content-center border border-5 border-white mb-4"
                                style="width: 75px; height: 75px;">
                                <i class="fa fa-star fa-2x text-primary"></i>
                            </div>
                            <h4 class="mb-3">{{ __('messages.kepuasan') }}</h4>
                            <p>{{ __('messages.kepuasan_desc') }}</p>
                            {{-- <a href="" class="btn bg-white text-primary w-100 mt-2">Read More<i
                                    class="fa fa-arrow-right text-secondary ms-2"></i></a>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">{{ __('messages.find_products') }}</h6>
                <h1 class="mb-5">{{ __('messages.our_products') }}</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
                    <div class="overflow-hidden">
                        <img class="img-fluid w-100 h-100" src="{{ asset('assets/img/produk/category-1.png') }}"
                            alt="">
                    </div>
                    <div class="d-flex align-items-center justify-content-between bg-light p-4">
                        <h5 class="text-truncate me-3 mb-0">Residential Plumbing</h5>
                        <a class="btn btn-square btn-outline-primary border-2 border-white flex-shrink-0" href="">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.3s">
                    <div class="overflow-hidden">
                        <img class="img-fluid w-100 h-100" src="{{ asset('assets/img/produk/category-2.png') }}"
                            alt="">
                    </div>
                    <div class="d-flex align-items-center justify-content-between bg-light p-4">
                        <h5 class="text-truncate me-3 mb-0">Commercial Plumbing</h5>
                        <a class="btn btn-square btn-outline-primary border-2 border-white flex-shrink-0" href="">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.5s">
                    <div class="overflow-hidden">
                        <img class="img-fluid w-100 h-100" src="{{ asset('assets/img/produk/category-4.png') }}"
                            alt="">
                    </div>
                    <div class="d-flex align-items-center justify-content-between bg-light p-4">
                        <h5 class="text-truncate me-3 mb-0">Emergency Servicing</h5>
                        <a class="btn btn-square btn-outline-primary border-2 border-white flex-shrink-0" href="">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Add space for better alignment -->
            <div class="text-center mt-4">
                <button class="btn btn-primary w-100 py-3" type="submit">{{ __('messages.explore_products') }}</button>
            </div>
        </div>
    </div>
    <!-- Service End -->



    <!-- Booking Start -->
    <div class="container-fluid my-5 px-0">
        <div class="video wow fadeInUp" data-wow-delay="0.1s">
            <button type="button" class="btn-play" data-bs-toggle="modal"
                data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                <span></span>
            </button>

            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- 16:9 aspect ratio -->
                            <div class="ratio ratio-16x9">
                                <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                                    allowscriptaccess="always" allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class="text-white mb-4">Emergency Plumbing Service</h1>
            <h3 class="text-white mb-0">24 Hours 7 Days a Week</h3>
        </div>
        <div class="container position-relative wow fadeInUp" data-wow-delay="0.1s" style="margin-top: -6rem;">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-light text-center p-5">
                        <h1 class="mb-4">Book For A Service</h1>
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Your Name"
                                        style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control border-0" placeholder="Your Email"
                                        style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select border-0" style="height: 55px;">
                                        <option selected>Select A Service</option>
                                        <option value="1">Service 1</option>
                                        <option value="2">Service 2</option>
                                        <option value="3">Service 3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text" class="form-control border-0 datetimepicker-input"
                                            placeholder="Service Date" data-target="#date1" data-toggle="datetimepicker"
                                            style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control border-0" placeholder="Special Request"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Our Technicians</h6>
                <h1 class="mb-5">Our Expert Technicians</h1>
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
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="text-secondary text-uppercase">Testimonial</h6>
                <h1 class="mb-5">Our Clients Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item text-center">
                    <div class="testimonial-text bg-light text-center p-4 mb-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                    <img class="bg-light rounded-circle p-2 mx-auto mb-2" src="img/testimonial-1.jpg"
                        style="width: 80px; height: 80px;">
                    <div class="mb-2">
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                    </div>
                    <h5 class="mb-1">Client Name</h5>
                    <p class="m-0">Profession</p>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-text bg-light text-center p-4 mb-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                    <img class="bg-light rounded-circle p-2 mx-auto mb-2" src="img/testimonial-2.jpg"
                        style="width: 80px; height: 80px;">
                    <div class="mb-2">
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                    </div>
                    <h5 class="mb-1">Client Name</h5>
                    <p class="m-0">Profession</p>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-text bg-light text-center p-4 mb-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                    <img class="bg-light rounded-circle p-2 mx-auto mb-2" src="img/testimonial-3.jpg"
                        style="width: 80px; height: 80px;">
                    <div class="mb-2">
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                    </div>
                    <h5 class="mb-1">Client Name</h5>
                    <p class="m-0">Profession</p>
                </div>
                <div class="testimonial-item text-center">
                    <div class="testimonial-text bg-light text-center p-4 mb-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                    <img class="bg-light rounded-circle p-2 mx-auto mb-2" src="img/testimonial-4.jpg"
                        style="width: 80px; height: 80px;">
                    <div class="mb-2">
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                        <small class="fa fa-star text-secondary"></small>
                    </div>
                    <h5 class="mb-1">Client Name</h5>
                    <p class="m-0">Profession</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
