@extends('layouts.Member.master')     
@section('content')

<div class="container mt-3">
    <h2 class="text-center mb-4">Ajukan Permintaan Quotation</h2>
    <p class="text-center mb-4">Keranjang Permintaan Quotation</p>
</div>

<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3" style="max-width: 900px; margin: auto;">
        <a href="{{ url('/en/products') }}" class="btn btn-dark" style="border-radius: 8px; padding: 8px 16px;">
            Ajukan Quotation
        </a>
    </div>

    <div class="card shadow border-0 rounded custom-card">
        <div class="card-body p-4">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th style="width: 40%;">Nama Produk</th>
                        <th style="width: 25%;">Quantity</th>
                        <th style="width: 25%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cartItems as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $item['nama'] }}</td>
                            <td class="text-center">
                                <form action="{{ route('quotations.cart.update') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="produk_id" value="{{ $item['produk_id'] }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                        class="form-control form-control-sm text-center"
                                        style="width: 60px; display: inline-block;">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Update</button>
                                </form>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('quotations.cart.remove') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="produk_id" value="{{ $item['produk_id'] }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
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
        <div class="d-flex justify-content-end mt-3" style="max-width: 900px; margin: auto;">
            <form action="{{ route('quotations.submit') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark" style="border-radius: 8px; padding: 8px 16px;">Ajukan Permintaan Quotation</button>
            </form>
        </div>
    @endif
</div>

@endsection

<style>
    /* Styling tabel dengan warna yang lebih jelas */
    .custom-card {
        max-width: 900px;
        margin: auto;
        background-color: #f8f9fa;
        border-radius: 10px;
    }

    .custom-table {
        border-collapse: collapse;
        width: 100%;
    }

    .custom-table th {
        background-color: #e0e0e0; /* abu-abu lebih muda */
        color: #333;
        font-weight: bold;
        text-align: center;
        padding: 12px;
        border: 1px solid #bbb; /* warna border yang lebih lembut */
    }

    .custom-table td {
        background-color: #ffffff; /* warna putih untuk konten */
        color: #555;
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .custom-table tbody tr:hover {
        background-color: #f3f3f3; /* warna hover */
    }
</style>

