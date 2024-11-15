@extends('layouts.Member.master') 
@section('content')

<div class="container mt-3"> 
    <h2 class="text-center mb-4">Pilih Produk & Permintaan Quotation</h2>
    <p class="text-center mb-4">Di sini Anda dapat memilih produk dan mengajukan permintaan quotation.</p>
</div>

<div class="container mt-4">
    <div class="text-end mb-3">
        <a href="{{ url('/en/products') }}" class="btn btn-primary" style="border-radius: 10px; padding: 10px 20px;">
            Ajukan Quotation
        </a>
        <a href="{{ route('quotations.cart') }}" class="btn btn-secondary"
            style="border-radius: 10px; padding: 10px 20px; margin-left: 10px;">
            Lihat Keranjang
        </a>
    </div>

    <!-- Quotation Requests Table -->
    <h3 class="mt-5">Daftar Permintaan Quotation</h3>
    <table class="table table-striped table-hover text-center" style="border: 2px solid #add8e6;"> <!-- Light blue border with centered text -->
        <thead>
            <tr>
                <th>No</th>
                <th>Hari & Tanggal</th>
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
                    <td>{{ \Carbon\Carbon::parse($quotation->created_at)->translatedFormat('l, d-m-Y') }}</td>
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
                        <!-- Icon View with Tooltip -->
                        <a href="{{ route('quotations.show', $quotation->id) }}" class="btn btn-info btn-lg" 
                           data-bs-toggle="tooltip" title="View">
                            <i class='bx bx-show'></i>
                        </a>

                        @if ($quotation->status === 'pending')
                            <!-- Batal Button -->
                            <form action="{{ route('quotations.cancel', $quotation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger btn-lg"
                                        onclick="return confirm('Apakah Anda yakin ingin membatalkan permintaan quotation ini?');"
                                        data-bs-toggle="tooltip" title="Cancel">
                                    <i class='bx bx-x-circle'></i>
                                </button>
                            </form>
                        @elseif($quotation->status === 'quotation')
                            <!-- Nego Button with Tooltip -->
                            <a href="{{ route('distributor.quotations.negotiations.create', $quotation->id) }}" 
                               class="btn btn-warning btn-lg" data-bs-toggle="tooltip" title="Nego">
                                <i class='bx bx-chat'></i>
                            </a>

                            @if (!$quotation->purchaseOrder)
                                <!-- Create PO Button with Tooltip -->
                                <a href="{{ route('quotations.create_po', $quotation->id) }}" 
                                   class="btn btn-success btn-lg" data-bs-toggle="tooltip" title="Create PO">
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

<!-- Inisialisasi Tooltip Bootstrap -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection
