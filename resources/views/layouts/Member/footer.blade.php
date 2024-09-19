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
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ $compro->no_telepon }}</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ $compro->email }}</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h4 class="text-light mb-4">Opening Hours</h4>
                    <h6 class="text-light">Monday - Friday:</h6>
                    <p class="mb-4">09.00 AM - 09.00 PM</p>
                    <h6 class="text-light">Saturday - Sunday:</h6>
                    <p class="mb-0">09.00 AM - 12.00 PM</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h4 class="text-light mb-4">Services</h4>
                    <a class="btn btn-link" href="">Drain Cleaning</a>
                    <a class="btn btn-link" href="">Sewer Line</a>
                    <a class="btn btn-link" href="">Water Heating</a>
                    <a class="btn btn-link" href="">Toilet Cleaning</a>
                    <a class="btn btn-link" href="">Broken Pipe</a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">{{ __('messages.leave_message') }}</h4>
                    <p>{{ __('messages.leave_message_desc') }}</p>
                    {{-- <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div> --}}
                    <div class="position-relative mx-auto" style="max-width: 400px; border-radius: 15px; padding: 20px; background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <form>
                            <div style="margin-bottom: 16px;">
                                <input
                                    class="form-control border-0 w-100"
                                    type="email"
                                    placeholder="Your email"
                                    style="padding: 12px 16px; border-radius: 8px; border: 1px solid #ddd; box-sizing: border-box;"
                                    required>
                            </div>
                            <div style="margin-bottom: 16px;">
                                <input
                                    class="form-control border-0 w-100"
                                    type="text"
                                    placeholder="Your message"
                                    style="padding: 12px 16px; border-radius: 8px; border: 1px solid #ddd; box-sizing: border-box;"
                                    required>
                            </div>
                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                                style="padding: 12px; border-radius: 8px; border: none; background-color: #1E60AA; color: #fff; font-size: 16px;">
                                Send Message
                            </button>
                        </form>
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
    <script src="{{ asset('assets/lib/wow/wow.min.js')}}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/member/main.js')}}"></script>
</body>

</html>
