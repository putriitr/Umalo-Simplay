@extends('layouts.Member.master')
@section('content')

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Keranjang Permintaan Quotation</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Keranjang Permintaan Quotation</li>
        </ol>
    </div>
</div>
<!-- Header End --><br><br>
 
<div class="container py-5">
    <h2 class="mb-4">Keranjang Permintaan Quotation</h2>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="text-end mb-3">
        <a href="{{ url('/en/products') }}" class="btn btn-primary" style="border-radius: 10px; padding: 10px 20px;">
            Ajukan Quotation
        </a>
    </div>
    <div class="card shadow-sm border-0 rounded">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cartItems as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td>
                                <form action="{{ route('quotations.cart.update') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="produk_id" value="{{ $item['produk_id'] }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px;">
                                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('quotations.cart.remove') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="produk_id" value="{{ $item['produk_id'] }}">
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Keranjang kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(count($cartItems) > 0)
        <form action="{{ route('quotations.submit') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-primary">Ajukan Permintaan Quotation</button>
        </form>
    @endif
</div>
@endsection 