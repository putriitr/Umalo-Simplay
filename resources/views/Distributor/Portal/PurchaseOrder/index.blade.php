@extends('layouts.Member.master')

@section('content')

<div class="container mt-5"></div>
<h1 class="text-center mb-4">Purchase Orders</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
        <li class="breadcrumb-item active text-primary">Daftar Purchase Orders</li>
    </ol>
</div>  

<div class="container mt-5">
    <!-- Tombol Navigasi -->
    <div class="d-flex justify-content-center justify-content-md-between mb-4 flex-wrap gap-3">
        <a href="{{ route('distribution.request-quotation') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="bx bx-search"></i> Lihat Quotation
        </a>
    </div>

    <!-- Tabel Daftar Purchase Orders -->
    <div class="card shadow-lg border-light rounded">
        <div class="card-body">
            <h3 class="mb-4 text-secondary">Daftar Purchase Orders</h3>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>PO Number</th>
                        <th>PO Date</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchaseOrders as $key => $po)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $po->po_number }}</td>
                            <td>{{ \Carbon\Carbon::parse($po->po_date)->format('d M Y') }}</td>
                            <td>
                                <span class="badge 
                                    @if ($po->status === 'pending') bg-warning
                                    @elseif ($po->status === 'approved') bg-success
                                    @elseif ($po->status === 'rejected') bg-danger
                                    @endif text-white">
                                    {{ ucfirst($po->status) }}
                                </span>
                            </td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('quotations.show', $po->quotation_id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bx bx-show"></i> Lihat
                                </a>

                                @if ($po->status === 'pending')
                                    <span class="text-muted">PO masih dalam peninjauan</span>
                                @elseif ($po->status === 'approved')
                                    @if ($po->proformaInvoice)
                                        <a href="{{ route('distributor.proforma-invoices.index', $po->proformaInvoice->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="bx bx-file"></i> Lihat Proforma Invoice
                                        </a>
                                    @else
                                        <span class="text-muted">Proforma Invoice akan segera dikirim</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada Purchase Order.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

<style>
    .btn-primary, .btn-outline-primary, .btn-info {
        display: inline-flex;
        align-items: center;
    }

    .btn-primary i, .btn-outline-primary i, .btn-info i {
        margin-right: 8px;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .table th, .table td {
        padding: 12px;
        text-align: center;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .badge {
        font-size: 1rem;
        padding: 5px 10px;
    }

    .alert-info {
        font-size: 1rem;
        padding: 20px;
    }

    .alert-info a {
        margin-top: 10px;
    }

    .card {
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .table th, .table td {
            padding: 8px;
        }

        .btn-primary, .btn-outline-primary, .btn-info {
            font-size: 1rem;
            padding: 8px 20px;
        }
    }

    @media (max-width: 576px) {
        .table th, .table td {
            padding: 6px;
        }

        .btn-primary, .btn-outline-primary, .btn-info {
            font-size: 0.9rem;
            padding: 8px 18px;
        }
    }
</style>
