@extends('layouts.Member.master') 
@section('content')
<div class="container mt-5">
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Purchase Orders</h3>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
                <li class="breadcrumb-item active text-primary">Purchase Orders</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <br><br>
    <h2>Your Purchase Orders</h2>
    @if ($purchaseOrders->isEmpty())
        <!-- Tampilkan pesan jika tidak ada Purchase Orders -->
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i> Anda belum memiliki Purchase Order. Silakan lihat Quotation Anda dan ajukan quotation untuk memulai proses.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <a href="{{ route('distribution.request-quotation') }}" class="btn btn-primary mt-3">Lihat Quotation</a>
        </div>
    @else
        <!-- Tambahkan Tombol Lihat Quotation di luar tabel -->
        <div class="mb-3">
            <a href="{{ route('distribution.request-quotation') }}" class="btn btn-primary"><i class="fas fa-search me-2"></i>Lihat Quotation</a>
        </div>

        <!-- Tabel Purchase Orders jika ada data -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>PO Number</th>
                        <th>PO Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseOrders as $po)
                        <tr>
                            <td>{{ $po->id }}</td>
                            <td>{{ $po->po_number }}</td>
                            <td>{{ \Carbon\Carbon::parse($po->po_date)->format('d M Y') }}</td>
                            <td>
                                <span class="badge 
                                    @if ($po->status === 'pending') bg-warning
                                    @elseif ($po->status === 'approved') bg-success
                                    @elseif ($po->status === 'rejected') bg-danger
                                    @endif">
                                    {{ ucfirst($po->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('quotations.show', $po->quotation_id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye me-1"></i> View Quotation
                                    </a>
                                    @if ($po->status === 'pending')
                                        <span class="text-muted">PO masih dalam peninjauan</span>
                                    @elseif ($po->status === 'approved')
                                        @if ($po->proformaInvoice)
                                            <a href="{{ route('distributor.proforma-invoices.index', $po->proformaInvoice->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-file-alt me-1"></i> View Proforma Invoice
                                            </a>
                                        @else
                                            <span class="text-muted">Proforma Invoice akan segera dikirim</span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
    