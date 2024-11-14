@extends('layouts.Member.master')
@section('content')

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Pilih Produk & Permintaan Quotation
            </h3>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
                <li class="breadcrumb-item active text-primary">Pilih Produk & Permintaan Quotation</li>
            </ol>
        </div>
    </div>

<!-- Header End --><br><br>

<div class="container">
        <h2>Pilih Produk & Permintaan Quotation</h2>
        <p>Di sini Anda dapat memilih produk dan mengajukan permintaan quotation.</p>
        <!-- Button to Redirect to Products Page -->
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
        <table class="table table-striped table-hover">
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
                        <!-- Kolom Hari & Tanggal -->
                        <td>{{ \Carbon\Carbon::parse($quotation->created_at)->translatedFormat('l, d-m-Y') }}</td>
                        <!-- Nama Produk dan Quantity -->
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
                        <!-- Status berdasarkan status di database -->
                        <td>
                            <span
                                class="badge 
    @if ($quotation->status === 'cancelled') bg-danger
    @elseif ($quotation->status === 'quotation') bg-success
    @else bg-warning @endif">
                                {{ ucfirst($quotation->status) }}
                            </span>
                        </td>
                        <!-- Actions -->
                        <td>
                            <a href="{{ route('quotations.show', $quotation->id) }}" class="btn btn-sm btn-info">View</a>
                            @if ($quotation->status === 'pending')
                                <!-- Tampilkan tombol Batal jika status Pending -->
                                <form action="{{ route('quotations.cancel', $quotation->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin membatalkan permintaan quotation ini?');">
                                        Batal
                                    </button>
                                </form>
                            @elseif($quotation->status === 'quotation')
                                <!-- Tampilkan tombol Nego dan Create PO jika status sudah Quotation -->
                                <a href="{{ route('distributor.quotations.negotiations.create', $quotation->id) }}"
                                    class="btn btn-sm btn-warning">Nego</a>
                                <a href="{{ route('quotations.create_po', $quotation->id) }}"
                                    class="btn btn-sm btn-success">Create PO</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada permintaan quotation.</td>
                    </tr>
                @endforelse
            </tbody>
        </table></thead>
            <tbody>
                @forelse($quotations as $key => $quotation)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <!-- Kolom Hari & Tanggal -->
                        <td>{{ \Carbon\Carbon::parse($quotation->created_at)->translatedFormat('l, d-m-Y') }}</td>
                        <!-- Nama Produk dan Quantity -->
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
                        <!-- Status berdasarkan status di database -->
                        <td>
                            <span
                                class="badge 
    @if ($quotation->status === 'cancelled') bg-danger
    @elseif ($quotation->status === 'quotation') bg-success
    @else bg-warning @endif">
                                {{ ucfirst($quotation->status) }}
                            </span>
                        </td>
                        <!-- Actions -->
                        <td>
                            <a href="{{ route('quotations.show', $quotation->id) }}" class="btn btn-sm btn-info">View</a>
                            @if ($quotation->status === 'pending')
                                <!-- Tampilkan tombol Batal jika status Pending -->
                                <form action="{{ route('quotations.cancel', $quotation->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin membatalkan permintaan quotation ini?');">
                                        Batal
                                    </button>
                                </form>
                            @elseif($quotation->status === 'quotation')
                                <!-- Tampilkan tombol Nego dan Create PO jika status sudah Quotation -->
                                <a href="{{ route('distributor.quotations.negotiations.create', $quotation->id) }}"
                                    class="btn btn-sm btn-warning">Nego</a>
                                <a href="{{ route('quotations.create_po', $quotation->id) }}"
                                    class="btn btn-sm btn-success">Create PO</a>
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
@endsection