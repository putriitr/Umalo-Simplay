@extends('layouts.Member.master')

@section('content')

<!-- Main Content -->
<div class="container my-5">

    <h1 class="text-center mb-4">Detail Permintaan Quotation</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
        <li class="breadcrumb-item active text-primary">Detail Permintaan Quotation</li>
    </ol>
</div>

<div class="container mt-5">
    <!-- Menampilkan Daftar Produk dalam Quotation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg border-light rounded">
                <div class="card-body">
                    <!-- Informasi Umum Quotation -->
                    <div class="row mb-4">
                        <div class="col-12">

                            <div class="card shadow-sm border-light rounded">
                                <div class="card-body">
                                    <h5 class="text-primary mb-3">Informasi Permintaan</h5>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <p class="mb-0" style="font-size: 1rem;"><strong>Status:</strong>
                                            <span
                                                class="badge bg-{{ $quotation->status == 'approved' ? 'success' : ($quotation->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($quotation->status) }}
                                            </span>
                                        </p>
                                    </div>
                                    <p class="mb-0" style="font-size: 1rem;"><strong>Tanggal Permintaan:</strong>
                                        {{ $quotation->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-4">
                        <div class="col-12">

                            <div class="card shadow-sm border-light rounded">
                                <div class="card-body">
                                    <h5 class="text-primary mb-3">Produk dalam Quotation:</h5>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center">No</th>
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
                                                        <td class="text-primary text-center">{{ $index + 1 }}</td>
                                                        <td>{{ $product->equipment_name ?? 'Produk tidak tersedia' }}</td>
                                                        <td>{{ $product->merk_type ?? 'Tidak tersedia' }}</td>
                                                        <td class="text-center">{{ $product->quantity }}</td>
                                                        <td class="text-center">{{ number_format($product->unit_price, 2) }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ number_format($product->total_price, 2) }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted">Tidak ada produk
                                                            dalam permintaan
                                                            quotation ini.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Menampilkan file PDF jika ada -->
                    <div class="row mb-4">
                        <div class="col-12">

                            <div class="card shadow-sm border-light rounded">
                                <div class="card-body">
                                    <h5 class="text-primary mb-3">Dokumen PDF:</h5>
                                    @if($quotation->pdf_path)
                                        <div class="d-flex gap-3">
                                            <a href="{{ asset($quotation->pdf_path) }}" target="_blank"
                                                class="btn btn-primary rounded-3">
                                                <i class="fas fa-file-alt me-2"></i>Lihat Dokumen PDF
                                            </a>
                                            <a href="{{ asset($quotation->pdf_path) }}" download
                                                class="btn btn-secondary rounded-3">
                                                <i class="fas fa-download me-2"></i>Download PDF
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada file yang tersedia.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection

<style>
    /* Custom Styling */
    .badge {
        font-weight: bold;
        padding: 0.5rem;
    }

    /* Table Styling */
    .table {
        font-size: 1rem;
        border-radius: 10px;
        border: 1px solid #ddd;
        /* Light gray border */
        background-color: #fff;
        color: #000;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    .table-light {
        background-color: #f8f9fa;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .text-primary {
        color: #17a2b8 !important;
    }

    /* Card Styling */
    .card {
        border-radius: 10px;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Button Styling */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-size: 1rem;
        padding: 10px 20px;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        font-size: 1rem;
        padding: 10px 20px;
    }

    .rounded-3 {
        border-radius: 20px;
    }

    /* Flex Layout for Documents */
    .d-flex {
        display: flex;
        align-items: center;
    }

    .gap-3 {
        gap: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }

        .table th,
        .table td {
            font-size: 0.9rem;
        }
    }
</style>