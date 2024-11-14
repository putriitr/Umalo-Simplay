@extends('layouts.Member.master')
@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Distributor Portal</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
            <li class="breadcrumb-item active text-primary">Distributor Portal</li>
        </ol>
    </div>
</div>
<!-- Header End --><br><br>
<!-- Services Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <!-- Pilih Produk & Minta Quotation -->
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                        <i class='bx bx-package' style="font-size: 200px; color: #fff;"></i>
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">Pilih Produk & Quotation</h5>
                            <a href="{{ route('distribution.request-quotation') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Ajukan Quotation</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kelola Invoice -->
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                        <i class='bx bx-receipt' style="font-size: 200px; color: #fff;"></i>
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">Invoice</h5>
                            <a href="{{ route('distribution.invoices') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Lihat Invoice</a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                        <i class='bx bx-conversation' style="font-size: 200px; color: #fff;"></i>
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">Lihat Negosiasi</h5>
                            <a href="{{ route('distributor.quotations.negotiations.index') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 200px; margin: 0 auto; background-color: #f8f9fa;">
                        <i class='bx bx-file' style="font-size: 200px; color: #000000;"></i> <!-- Icon PO -->
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">Lihat PO</h5>
                            <a href="{{ route('distributor.purchase-orders.index') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Lihat PO</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ticketing -->
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-img rounded-top"
                        style="display: flex; justify-content: center; align-items: center; height: 200px; width: 250px; margin: 0 auto; background-color: #1E60AA;">
                        <i class='bx bx-receipt' style="font-size: 200px; color: #fff;"></i>
                    </div>
                    <div class="service-content rounded-bottom bg-light p-4">
                        <div class="service-content-inner">
                            <h5 class="mb-4">Ticketing</h5>
                            <a href="{{ route('distribution.tickets.index') }}"
                                class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->
@endsection