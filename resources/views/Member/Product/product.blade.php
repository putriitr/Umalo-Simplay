@extends('layouts.member.master')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <!-- Sidebar Start -->
            <div class="col-lg-3">
                <h4 class="mb-4 text-dark font-weight-bold">{{ __('messages.category_product') }}</h4>
                <ul class="list-group mb-4 shadow-sm">
                    @foreach($kategori as $kat)
                        <li class="list-group-item border-0 rounded text-center py-3 mb-2 shadow-sm"
                            style="cursor: pointer; background-color: {{ $selectedCategory && $selectedCategory->id == $kat->id ? '#6196FF' : '#f8f9fa' }}; transition: background-color 0.3s ease, color 0.3s ease;"
                            onmouseover="this.style.backgroundColor='#6196FF'; this.style.color='#fff';"
                            onmouseout="this.style.backgroundColor='{{ $selectedCategory && $selectedCategory->id == $kat->id ? '#6196FF' : '#f8f9fa' }}'; this.style.color='{{ $selectedCategory && $selectedCategory->id == $kat->id ? '#fff' : '#000' }}';"
                            onclick="window.location.href='{{ route('filterByCategory', $kat->id) }}'">
                            <strong>{{ $kat->nama }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- Sidebar End -->

            <!-- Main Content Start -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between mb-4">
                    <h3 class="font-weight-bold" style="color: #6196FF;">{{ __('messages.explore_product') }}</h3>
                    <select class="form-select w-25 border-0 bg-light shadow-sm">
                        <option selected>{{ __('messages.sort_by') }}</option>
                        <option value="1">{{ __('messages.newest') }}</option>
                        <option value="2">{{ __('messages.latest') }}</option>
                    </select>
                </div>

                <div class="row">
                    @foreach ($produks as $produk)
                    <div class="col-md-4 mb-4">
                        <div class="card product-card border-0 shadow-sm"
                            style="overflow: hidden; transition: transform 0.3s ease; border-radius: 10px; height: 400;">
                            <a href="{{ route('product.show', $produk->id) }}">
                                <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                                    class="card-img-top" alt="{{ $produk->nama }}"
                                    style="object-fit: contain; height: 250; transition: transform 0.3s ease;">
                            </a>
                            <div class="card-body text-center">
                                @php
                                    $name = $produk->nama;
                                    $limitedName = strlen($name) > 22 ? substr($name, 0, 22) . '..' : $name;
                                @endphp
                                <h5 class="card-title text-dark font-weight-bold">{{ $limitedName }}</h5>
                                <a href="{{ route('product.show', $produk->id) }}"
                                    class="btn btn-outline-primary rounded-pill px-4 py-2 mt-3"
                                    style="transition: background-color 0.3s ease; border-color: #6196FF; color:#6196FF;">
                                    View Product →
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Main Content End -->
        </div>
    </div>
@endsection

<!-- Additional Custom CSS -->
<style>
    /* General layout adjustments */
    .container-fluid.bg-breadcrumb {
        background-size: cover;
        background-position: center;
        color: #fff;
    }

    /* Product cards */
    .product-card {
        border-radius: 12px;
        background-color: #fff;
        transition: all 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
    }

    /* Button styles */
    .btn-outline-primary {
        border: 2px solid #007bff;
        color: #007bff;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Image hover effects */
    .product-card img {
        transition: transform 0.3s ease;
    }

    .product-card:hover img {
        transform: scale(1.05);
    }

    /* Breadcrumbs */
    .breadcrumb-item a {
        color: #333;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    /* Custom Typography */
    h1,
    h3,
    h5 {
        font-family: 'Montserrat', sans-serif;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
</style>
