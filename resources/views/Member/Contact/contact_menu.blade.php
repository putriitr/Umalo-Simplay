@extends('layouts.member.master')

@php
    $compro = \App\Models\CompanyParameter::first();
    $brand = \App\Models\BrandPartner::where('type', 'brand', 'nama')->get();
@endphp

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header mb-5 py-5"
        style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .1)), url('{{ asset('assets/img/contact.jpg') }}') center center no-repeat; background-size: cover; height: 300px;">
        <div class="container">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{ __('messages.contact') }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">{{ __('messages.home') }}</a>
                    </li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{ __('messages.contact') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->

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
                                <a href="https://maps.app.goo.gl/tyu8r4ncFS69fCmH7" target="_blank"
                                    class="d-flex align-items-center justify-content-center mb-3"
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
                                <a href="mailto:info@labtek.id"
                                    class="d-flex align-items-center justify-content-center mb-3"
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
                            <div class="d-flex flex-column align-items-center text-center mb-2">
                                <a href="https://www.labtek.id" target="_blank"
                                    class="d-flex align-items-center justify-content-center mb-3"
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
            <!-- Booking Start -->
            <div class="container-fluid my-5 px-0"><br><br></div>
            <div class="container position-relative wow fadeInUp" data-wow-delay="0.1s" style="margin-top: -6rem;">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="bg-light text-center p-5">
                            <h1 class="mb-4">{{ __('messages.leave_message') }}</h1>
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
                                                placeholder="Service Date" data-target="#date1"
                                                data-toggle="datetimepicker" style="height: 55px;">
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
    </div>
    </div>
    <!-- Contact End -->
@endsection
