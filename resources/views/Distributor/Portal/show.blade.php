@extends('layouts.Member.master')
@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Detail Permintaan Quotation</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Detail Permintaan Quotation</li>
        </ol>
    </div>
</div>
<!-- Header End --><br><br>

<div class="container">
    <h2>Detail Permintaan Quotation</h2>
    <!-- Informasi Umum Quotation -->
     
    <p><strong>Status:</strong> {{ ucfirst($quotation->status) }}</p>
    <p><strong>Tanggal Permintaan:</strong> {{ $quotation->created_at->format('d M Y') }}</p>

    <!-- Menampilkan Daftar Produk dalam Quotation -->
    <h4>Produk dalam Quotation:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Merk</th>
                <th>Quantity</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($quotation->quotationProducts as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->equipment_name ?? 'Produk tidak tersedia' }}</td>
                    <td>{{ $product->merk_type ?? 'Tidak tersedia' }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ number_format($product->unit_price, 2) }}</td>
                    <td>{{ number_format($product->total_price, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Tidak ada produk dalam permintaan quotation ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Menampilkan file PDF jika ada -->
    <div class="mt-4">
        <strong>Dokumen PDF:</strong>
        @if($quotation->pdf_path)
            <p>
                <a href="{{ asset($quotation->pdf_path) }}" target="_blank" class="text-primary">
                    <i class="fas fa-file-alt me-2"></i>Lihat Dokumen PDF
                </a>
            </p>
            <p>
                <a href="{{ asset($quotation->pdf_path) }}" download class="text-secondary">
                    <i class="fas fa-download me-2"></i>Download PDF
                </a>
            </p>
        @else
            <p class="text-muted">No file</p>
        @endif
    </div>
    
    <a href="{{ route('distribution.request-quotation') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection