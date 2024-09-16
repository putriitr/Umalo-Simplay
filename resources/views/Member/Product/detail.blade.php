@extends('layouts.member.master')

@section('content')
<div class="container mt-4 py-5 mb-5" style="background-color: #f9f9f9; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
    <!-- Banner Section -->
    <div class="bg-light p-5 rounded" style="box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-5 text-primary font-weight-bold">{{ $produk->nama }}</h1>
                <p class="lead mt-3" style="font-size: 1rem; color: #555;">
                    {{ $produk->kegunaan }}
                </p>
            </div>
            <div class="col-md-6 text-center">
                @if($produk->images->count() > 1)
                    <!-- Bootstrap Carousel for multiple images -->
                    <div id="productImageCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($produk->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset($image->gambar) }}" alt="{{ $produk->nama }}" 
                                     class="img-fluid w-100" style="height: 350; object-fit: cover; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);">
                            </div>
                            @endforeach
                        </div>
                        
                        <a class="carousel-control-prev" href="#productImageCarousel" role="button" data-bs-slide="prev" style="width: 40px; height: 40px; background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; display: flex; justify-content: center; align-items: center; top: 50%; transform: translateY(-50%);">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1); width: 20px; height: 20px;"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#productImageCarousel" role="button" data-bs-slide="next" style="width: 40px; height: 40px; background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; display: flex; justify-content: center; align-items: center; top: 50%; transform: translateY(-50%);">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1); width: 20px; height: 20px;"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                        
                        
                        
                    </div>
                @else
                    <!-- Display single image if there's only one -->
                    <img src="{{ asset($produk->images->first()->gambar ?? 'assets/img/default.jpg') }}" 
                         alt="{{ $produk->nama }}" class="img-fluid" 
                         style="max-height: 350px; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);">
                @endif
            </div>
        </div>
    </div>
    

</div>
    <!-- Spacer -->
    <div class="my-5"></div>

<div class="container mt-4 py-5 mb-5" style="background-color: #f9f9f9; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">

    <!-- Similar Products Section -->
    <h2 class="text-center text-uppercase font-weight-bold mb-5 " style="letter-spacing: 2px;">Produk Serupa</h2>
    <div class="bg-light p-5 rounded" style="box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);">
        <div class="row">
            @foreach($produkSerupa as $similarProduct)
            <div class="col-md-3 mb-4">
                <div class="product-card text-center" style="border-radius: 10px; overflow: hidden; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                    <a href="{{ route('product.show', $similarProduct->id) }}" class="d-block" style="text-decoration: none;">
                        <img src="{{ asset($similarProduct->images->first()->gambar ?? 'assets/img/default.jpg') }}"
                             class="img-fluid w-100" alt="{{ $similarProduct->nama }}"
                             style="max-height: 220px; object-fit: cover; transition: transform 0.3s ease;">
                    </a>
                    <div class="p-3" style="background-color: #fff;">
                        <h5 class="mt-2 text-dark font-weight-bold">{{ $similarProduct->nama }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
    </div>
</div>
</div>

<!-- Custom CSS -->
<style>
    /* Hover effect on product cards */
    .product-card:hover {
        transform: translateY(-10px);
    }
    .product-card img:hover {
        transform: scale(1.1);
    }

    /* Text Styles */
    .text-primary {
        color: #007bff !important;
    }

    /* Font weight and shadow for heading */
    h1, h2 {
        font-weight: 700;
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
