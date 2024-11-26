@extends('layouts.Member.master')

@section('content')

<div class="container mt-5">
<h1 class="text-center mb-4">{{ __('messages.purchase_orders') }}</h1>
    <ol>
        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
        <li class="breadcrumb-item active text-primary">{{ __('messages.purchase_orders') }}</li>
    </ol>
</div>  

<div class="container mt-5">
    <!-- Tombol Navigasi -->
    <div class="d-flex justify-content-center justify-content-md-between mb-4 flex-wrap gap-3">
        <a href="{{ route('distribution.request-quotation') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="bx bx-search"></i> {{ __('messages.view_quotation') }}
        </a>
    </div>

    <!-- Tabel Daftar Purchase Orders -->
    <div class="card shadow-lg border-light rounded">
        <div class="card-body">
            <h3 class="mb-4 text-secondary">{{ __('messages.purchase_orders') }}</h3>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.po_number') }}</th>
                        <th>{{ __('messages.po_date') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.actions') }}</th>
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
                                    {{ ucfirst(__('messages.' . $po->status)) }}
                                </span>
                            </td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('quotations.show', $po->quotation_id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bx bx-show"></i> {{ __('messages.view') }}
                                </a>

                                @if ($po->status === 'pending')
                                    <span class="text-muted">{{ __('messages.po_pending') }}</span>
                                @elseif ($po->status === 'approved')
                                    @if ($po->proformaInvoice)
                                        <a href="{{ route('distributor.proforma-invoices.index', $po->proformaInvoice->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="bx bx-file"></i> {{ __('messages.proforma_invoice') }}
                                        </a>
                                    @else
                                        <span class="text-muted">{{ __('messages.proforma_invoice_pending') }}</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">{{ __('messages.no_purchase_orders') }}</td>
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
