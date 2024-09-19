@extends('layouts.member.master')

@php
$compro = \App\Models\CompanyParameter::first();
$brand = \App\Models\BrandPartner::where('type', 'brand', 'nama')->get();
@endphp

@section('content')
<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="container-fluid">
            <div class="row text-center justify-content-center">
                <h1 class="mb-4">Contact Us For Any Query</h1>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="tel:(021) 85850913" class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-phone-alt fa-2x" style="color: white;"></i>
                            </a>
                            <h5 class="text-dark">PHONE</h5>
                            <p class="mb-0 text-dark" style="font-weight: bold;">{{ $compro->no_telepon }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <div class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF;">
                                <i class="fab fa-whatsapp fa-3x" style="color: white;"></i>
                            </div>
                            <h5 class="text-dark">WORK TIME</h5>
                            <p class="mb-0 text-dark" style="font-weight: bold;">{{ $compro->no_wa }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="https://maps.app.goo.gl/tyu8r4ncFS69fCmH7" target="_blank" class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-map-marker-alt fa-2x" style="color: white;"></i>
                            </a>
                            <h5 class="text-dark">ADDRESS</h5>
                            <p class="mb-0 text-dark" style="font-weight: bold;">{{ $compro->alamat }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">
                            <a href="mailto:info@labtek.id" class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-envelope-open fa-2x" style="color: white;"></i>
                            </a>
                            <h5 class="text-dark">EMAIL</h5>
                            <p class="mb-0 text-dark" style="font-weight: bold;">{{ $compro->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-2">s
                            <a href="https://www.labtek.id" target="_blank" class="d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px; background-color: #6196FF; text-decoration: none;">
                                <i class="fa fa-globe fa-2x" style="color: white;"></i>
                            </a>
                            <h5 class="text-dark">WEBSITE</h5>
                            <p class="mb-0 text-dark" style="font-weight: bold;">{{ $compro->website }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row g-4">
            <div class="col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15865.583185041489!2d106.8600596!3d-6.2114159!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f33d51cd6119%3A0x1bc64c80b9328ca6!2sPT.%20Arkamaya%20Guna%20Saharsa!5e0!3m2!1sid!2sid!4v1724830322086!5m2!1sid!2sid" width="1100" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection
