@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h1>Buat Data Monitoring untuk {{ $userProduk->produk->nama }}</h1>
        </div>
        <div class="card-body">
            <!-- Form to create monitoring data -->
            <form action="{{ route('admin.monitoring.store') }}" method="POST">
                @csrf

                <!-- Hidden input for user_produk_id -->
                <input type="hidden" name="user_produk_id" value="{{ $userProduk->id }}">

                <!-- Display the selected product name (disabled input for product) -->
                <div class="form-group">
                    <label for="product_name">Produk yang dipilih</label>
                    <input type="text" class="form-control" value="{{ $userProduk->produk->nama }}" disabled>
                </div>

                <!-- Status Barang input -->
                <div class="form-group">
                    <label for="status_barang">Status Barang</label>
                    <input type="text" name="status_barang" id="status_barang" class="form-control" required>
                </div>

                <!-- Kondisi Terakhir Produk input -->
                <div class="form-group">
                    <label for="kondisi_terakhir_produk">Kondisi Terakhir Produk</label>
                    <input type="text" name="kondisi_terakhir_produk" id="kondisi_terakhir_produk" class="form-control" required>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Buat Data Monitoring</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
