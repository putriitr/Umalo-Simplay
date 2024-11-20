@extends('layouts.Member.master')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Pilih Produk & Permintaan Quotation</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
        <li class="breadcrumb-item active text-primary">Pilih Produk & Quotation</li>
    </ol>
</div>


<div class="container mt-5">
    <div class="d-flex justify-content-center justify-content-md-between mb-4 flex-wrap gap-3">
        <a href="{{ url('/en/products') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="bx bx-file"></i> Ajukan Quotation
        </a>
        <a href="{{ route('quotations.cart') }}" class="btn btn-info btn-lg shadow-sm">
            <i class="bx bx-cart"></i> Lihat Keranjang
        </a>
    </div>

    <!-- Tabel Daftar Permintaan Quotation -->
    <div class="card shadow-lg border-light rounded">
        <div class="card-body">
            <h3 class="mb-4 text-secondary">Daftar Permintaan Quotation</h3>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nomor Pengajuan</th>
                        <th>Nama Produk</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotations as $key => $quotation)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $quotation->nomor_pengajuan ?? 'Nomor pengajuan tidak tersedia' }}</td>
                            <td>
                                @foreach ($quotation->quotationProducts as $product)
                                    <span class="d-block">{{ $product->equipment_name ?? 'Produk tidak tersedia' }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($quotation->quotationProducts as $product)
                                    <span class="d-block">{{ $product->quantity }}</span>
                                @endforeach
                            </td>
                            <td>
                                <span class="badge 
                                    @if ($quotation->status === 'cancelled') bg-danger
                                    @elseif ($quotation->status === 'quotation') bg-primary
                                    @else bg-warning @endif text-white">
                                    {{ ucfirst($quotation->status) }}
                                </span>
                            </td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('quotations.show', $quotation->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bx bx-show"></i> Lihat
                                </a>
                                
                                @if ($quotation->status === 'pending')
                                    <form action="{{ route('quotations.cancel', $quotation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin membatalkan permintaan quotation ini?');">
                                            <i class="bx bx-x-circle"></i> Batalkan
                                        </button>
                                    </form>
                                @elseif($quotation->status === 'quotation')
                                    @if (!$quotation->purchaseOrder)
                                        <a href="{{ route('distributor.quotations.negotiations.create', $quotation->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bx bx-dollar-circle"></i> Negosiasi
                                        </a>
                                        <a href="{{ route('quotations.create_po', $quotation->id) }}" class="btn btn-success btn-sm">
                                            <i class="bx bx-file"></i> Buat PO
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
    </div>
</div>

@endsection

