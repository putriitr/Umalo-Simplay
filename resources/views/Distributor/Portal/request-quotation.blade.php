@extends('layouts.Member.master')  
@section('content')

<div class="container mt-3">
    <h2 class="text-center mb-4">Pilih Produk & Permintaan Quotation</h2>
    <p class="text-center mb-4">Di sini Anda dapat memilih produk dan mengajukan permintaan quotation.</p>
</div>

<div class="container mt-4">
    <div class="text-end mb-3">
        <a href="{{ url('/en/products') }}" class="btn btn-primary btn-lg" data-bs-toggle="tooltip"
            title="Ajukan Quotation" style="border-radius: 10px; padding: 5px 20px;">
            <i class='bx bx-file'></i>
        </a>
        <a href="{{ route('quotations.cart') }}" class="btn btn-success btn-lg" data-bs-toggle="tooltip"
            title="Lihat Keranjang" style="border-radius: 10px; padding: 5px 20px; margin-left: 10px;">
            <i class='bx bx-cart'></i>
        </a>
    </div>

    <!-- Quotation Requests Table -->
    <h3 class="mt-5">Daftar Permintaan Quotation</h3>
    <table class="table custom-table text-center" style="border: 2px solid #ccc; border-radius: 10px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Pengajuan</th>
                <th>Nama Produk</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($quotations as $key => $quotation)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $quotation->nomor_pengajuan ?? 'Nomor pengajuan tidak tersedia' }}</td>
                    <td>
                        @foreach ($quotation->quotationProducts as $product)
                            - {{ $product->equipment_name ?? 'Produk tidak tersedia' }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($quotation->quotationProducts as $product)
                            {{ $product->quantity }} <br>
                        @endforeach
                    </td>
                    <td>
                        <span class="badge 
                                @if ($quotation->status === 'cancelled') bg-danger
                                @elseif ($quotation->status === 'quotation') bg-success
                                @else bg-warning @endif">
                            {{ ucfirst($quotation->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('quotations.show', $quotation->id) }}" class="btn btn-info btn-lg"
                            data-bs-toggle="tooltip" title="View">
                            <i class='bx bx-show'></i>
                        </a>

                        @if ($quotation->status === 'pending')
                            <form action="{{ route('quotations.cancel', $quotation->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger btn-lg"
                                    onclick="return confirm('Apakah Anda yakin ingin membatalkan permintaan quotation ini?');"
                                    data-bs-toggle="tooltip" title="Cancel">
                                    <i class='bx bx-x-circle'></i>
                                </button>
                            </form>
                        @elseif($quotation->status === 'quotation')
                            <!-- Tampilkan tombol Nego jika status adalah 'quotation' dan belum ada PO -->
                            @if (!$quotation->purchaseOrder)
                                <a href="{{ route('distributor.quotations.negotiations.create', $quotation->id) }}"
                                    class="btn btn-sm btn-warning">Nego</a>
                                <a href="{{ route('quotations.create_po', $quotation->id) }}" class="btn btn-success btn-lg"
                                    data-bs-toggle="tooltip" title="Create PO">
                                    <i class='bx bx-file'></i>
                                </a>
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada permintaan quotation.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection

<style>
    .custom-table {
        border-collapse: collapse;
        width: 100%;
        background-color: #f5f5f5;
        border-radius: 10px;
        /* Membuat sudut tabel melengkung */
    }

    .custom-table th,
    .custom-table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .custom-table th {
        background-color: #d3d3d3;
        color: #333;
        font-weight: bold;
        border-top-left-radius: 10px;
        /* Sudut kiri atas melengkung */
        border-top-right-radius: 10px;
        /* Sudut kanan atas melengkung */
    }

    .custom-table tbody tr:hover {
        background-color: #e8e8e8;
    }

    .custom-table td:first-child {
        border-top-left-radius: 10px;
        /* Sudut kiri bawah melengkung */
    }

    .custom-table td:last-child {
        border-top-right-radius: 10px;
        /* Sudut kanan bawah melengkung */
    }

    .badge {
        font-size: 0.9rem;
        padding: 8px 15px;
    }

    .btn {
        border-radius: 50px;
        padding: 8px 15px;
        margin: 0 5px;
    }

    .btn-lg {
        font-size: 1rem;
    }
</style>