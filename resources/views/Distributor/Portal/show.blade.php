@extends('layouts.Member.master') 
@section('content')

<!-- Main Content -->
<div class="container my-5">
    <div class="row mb-4 justify-content-center">
        <div class="col-12 text-center">
            <h2 class="text-primary">Detail Permintaan Quotation</h2>
        </div>
    </div>

    <!-- Informasi Umum Quotation -->
    <div class="mb-4">
        <p><strong>Status:</strong> <span
                class="badge bg-{{ $quotation->status == 'approved' ? 'success' : ($quotation->status == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($quotation->status) }}</span>
        </p>
        <p><strong>Tanggal Permintaan:</strong> {{ $quotation->created_at->format('d M Y') }}</p>
    </div>

    <!-- Menampilkan Daftar Produk dalam Quotation -->
    <h4 class="mb-3 text-primary">Produk dalam Quotation:</h4>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
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
                    <td class="text-primary">{{ $index + 1 }}</td> <!-- Urutan Biru Muda -->
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
            <div class="d-flex gap-3">
                <a href="{{ asset($quotation->pdf_path) }}" target="_blank" class="btn btn-primary rounded-3">
                    <i class="fas fa-file-alt me-2"></i>Lihat Dokumen PDF
                </a>
                <a href="{{ asset($quotation->pdf_path) }}" download class="btn btn-secondary rounded-3">
                    <i class="fas fa-download me-2"></i>Download PDF
                </a>
            </div>
        @else
            <p class="text-muted">Tidak ada file yang tersedia.</p>
        @endif
    </div>
</div>

@endsection

<style>
    /* Custom Styling */
    .bg-breadcrumb {
        background-color: #343a40;
    }

    .breadcrumb a {
        color: #f8f9fa !important;
    }

    .breadcrumb-item.active {
        color: #17a2b8;
    }

    .badge {
        font-weight: bold;
    }

    /* Table Styling */
    .table {
        font-size: 1.1rem;
        border-radius: 10px; /* Sudut melengkung */
        border: 1px solid #000; /* Border hitam */
        background-color: #fff; /* Konten putih */
        color: #000; /* Warna teks hitam */
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa; /* Warna baris ganjil putih */
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #17a2b; /* Border hitam */
        padding: 12px;
        text-align: center;
    }

    .table thead {
        background-color: #6c757d; /* Header abu-abu */
        color: #fff; /* Teks putih pada header */
    }

    /* Warna Urutan No Tabel Biru Muda */
    .text-primary {
        color: #17a2b8 !important; /* Biru muda */
    }

    /* Button Styling */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    /* Rounded Button Styling */
    .rounded-3 {
        border-radius: 20px; /* Sudut melengkung */
    }

    .d-flex {
        display: flex;
    }

    .gap-3 {
        gap: 1rem;
    }

    /* Buttons */
    .btn-lg {
        padding: 10px 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            margin-top: 20px;
        }
    }
</style>

