@php
    $compro = \App\Models\CompanyParameter::first();
    $brand = \App\Models\BrandPartner::where('type', 'brand', 'nama')->get();
@endphp


<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h4 class="text-light mb-4">{{ __('messages.contact_info') }}</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ $compro->alamat }}</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ $compro->email }}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ $compro->no_telepon }}</p>
                <p class="mb-2"><i class="fab fa-whatsapp me-3"></i>{{ $compro->no_wa }}</p>
                {{-- <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btan-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                </div> --}}
            </div>
            <div class="col-lg-2 col-md-6">
                <h4 class="text-light mb-4">{{ __('messages.quick_access') }}</h4>
                <a class="btn btn-link" href="{{ route('home') }}">{{ __('messages.home') }}</a>
                <a class="btn btn-link" href="{{ route('contact') }}">{{ __('messages.contact') }}</a>
                <a class="btn btn-link" href="{{ route('contact') }}#message">{{ __('messages.send_message') }}</a>
            </div>
            <div class="col-lg-2 col-md-6">
                <h4 class="text-light mb-4">{{ __('messages.company') }}</h4>
                <a class="btn btn-link" href="{{ route('about') }}">{{ __('messages.about_us') }}</a>
                <a class="btn btn-link" href="{{ route('product.index') }}">{{ __('messages.our_products') }}</a>
                <a class="btn btn-link" href="{{ route('activity') }}">{{ __('messages.activity') }}</a>
                <a class="btn btn-link" href="{{ route('home') }}#brand">{{ __('messages.our_brand') }}</a>
                <a class="btn btn-link" href="{{ route('about') }}#user">{{ __('messages.our_customers') }}</a>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="position-relative mx-auto"
                    style="max-width: 800px; border-radius: 15px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="row g-4">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.8803010736515!2d106.83694257090238!3d-6.146774977957632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5ed25a08aaf%3A0x6bd51421a5f90085!2sJl.%20Rajawali%20Selatan%20Raya%2C%20Gn.%20Sahari%20Utara%2C%20Kecamatan%20Sawah%20Besar%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1726807366854!5m2!1sid!2sid"
                            width="1500" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-12 text-center">
                    2024 &copy; {{ __('messages.company_name') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href='https://unpkg.com/boxicons@latest/css/boxicons.min.css'>
<link rel="styleshceet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('assets/js/member/main.js') }}"></script>
</body>

</html>
