@extends('layouts.Member.master')      
@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Ajukan Permintaan Quotation</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
        <li class="breadcrumb-item active text-primary">Keranjang Permintaan Quotation</li>
    </ol>
    <div class="container mt-5">
        <!-- Tombol Navigasi -->
        <div class="d-flex justify-content-center justify-content-md-between mb-4 flex-wrap gap-3">
            <a href="{{ url('/en/products') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="bx bx-file"></i> Ajukan Quotation
            </a>
        </div>

        <!-- Card untuk tabel Keranjang -->
        <div class="card shadow-lg border-light rounded">
            <div class="card-body">
                <h3 class="mb-4 text-secondary">Keranjang Permintaan Quotation</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Quantity</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cartItems as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $item['nama'] }}</td>
                                <td class="text-center">
                                    <form action="{{ route('quotations.cart.update') }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="produk_id" value="{{ $item['produk_id'] }}">
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                            class="form-control form-control-sm text-center"
                                            style="width: 60px; display: inline-block;">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('quotations.cart.remove') }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="produk_id" value="{{ $item['produk_id'] }}">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
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

        <!-- Tombol Ajukan Permintaan Quotation jika ada item di keranjang -->
        @if(count($cartItems) > 0)
            <div class="d-flex justify-content-center mt-4">
                <form action="{{ route('quotations.submit') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">Ajukan Permintaan Quotation</button>
                </form>
            </div>
        @endif
    </div>
</div>
</div>

@endsection

<style>
    /* Styling untuk Card dan Tabel */
    .card {
        border-radius: 10px;
    }

    .card-body {
        padding: 2rem;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        text-align: center;
        padding: 12px;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table-light {
        background-color: #f8f9fa;
    }

    .btn-outline-primary {
        border-radius: 8px;
    }

    .btn-outline-danger {
        border-radius: 8px;
    }

    .btn-lg {
        padding: 12px 20px;
    }

    .btn-sm {
        padding: 6px 12px;
    }

    .shadow-sm {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .shadow-lg {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Styling untuk Tombol Ajukan Quotation */
    .btn-primary {
        border-radius: 8px;
        padding: 8px 16px;
    }
</style>