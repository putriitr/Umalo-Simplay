@extends('layouts.Member.master') 

@section('content')

<div class="container mt-5"></div>
<h1 class="text-center mb-4">{{ __('messages.proforma_invoices_list') }}</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
        <li class="breadcrumb-item active text-primary">{{ __('messages.proforma_invoices') }}</li>
    </ol>
</div>

<div class="container mt-5">

    <!-- Tabel Proforma Invoices -->
    <div class="card shadow-lg border-light rounded">
        <div class="card-body">
            <h3 class="mb-4 text-secondary">{{ __('messages.proforma_invoices_list') }}</h3>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($proformaInvoices->isEmpty())
                <div class="alert alert-info">
                    <p>{{ __('messages.no_proforma_invoices') }}</p>
                    <p>{{ __('messages.create_po_first') }}</p>
                    <a href="{{ route('distributor.purchase-orders.index') }}" class="btn btn-warning w-100">{{ __('messages.view_purchase_orders') }}</a>
                </div>
            @else
                        <div class="mb-3">
                            <a href="{{ route('distributor.invoices.index') }}" class="btn btn-dark rounded-3">
                                <i class="fas fa-file-invoice"></i> {{ __('messages.view_invoices') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">{{ __('messages.id') }}</th>
                                    <th class="text-center">{{ __('messages.pi_number') }}</th>
                                    <th class="text-center">{{ __('messages.pi_date') }}</th>
                                    <th class="text-center">{{ __('messages.po_number') }}</th>
                                    <th class="text-center">{{ __('messages.subtotal') }}</th>
                                    <th class="text-center">{{ __('messages.ppn') }}</th>
                                    <th class="text-center">{{ __('messages.grand_total') }}</th>
                                    <th class="text-center">{{ __('messages.dp') }}</th>
                                    <th class="text-center">{{ __('messages.remaining_payment') }}</th>
                                    <th class="text-center">{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proformaInvoices as $invoice)
                                    <tr>
                                        <td class="text-center">{{ $invoice->id }}</td>
                                        <td class="text-center">{{ $invoice->pi_number }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($invoice->pi_date)->format('d M Y') }}</td>
                                        <td class="text-center">{{ $invoice->purchaseOrder->po_number }}</td>
                                        <td class="text-center">{{ number_format($invoice->subtotal, 2) }}</td>
                                        <td class="text-center">{{ number_format($invoice->ppn, 2) }}</td>
                                        <td class="text-center">{{ number_format($invoice->grand_total_include_ppn, 2) }}</td>
                                        <td class="text-center">{{ number_format($invoice->dp, 2) }} ({{ $invoice->dp_percent }}%)</td>
                                        <td class="text-center">{{ number_format($invoice->remaining_payment, 2) }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- View PDF -->
                                                    <a href="{{ asset($invoice->file_path) }}" target="_blank"
                                                        class="btn btn-info btn-sm mb-2 w-100">
                                                        <i class="fas fa-eye"></i> {{ __('messages.view_pdf') }}
                                                    </a>

                                                    <!-- View DP Proof if exists -->
                                                    @if($invoice->payment_proof_path)
                                                        <a href="{{ asset($invoice->payment_proof_path) }}" target="_blank"
                                                            class="btn btn-info btn-sm mb-2 w-100">
                                                            <i class="fas fa-eye"></i> {{ __('messages.view_dp_proof') }}
                                                        </a>

                                                        <!-- View Remaining Payment Proof if exists -->
                                                        @if($invoice->second_payment_proof_path)
                                                            <a href="{{ asset($invoice->second_payment_proof_path) }}" target="_blank"
                                                                class="btn btn-info btn-sm mb-2 w-100">
                                                                <i class="fas fa-eye"></i> {{ __('messages.view_remaining_payment_proof') }}
                                                            </a>
                                                        @else
                                                            <form action="{{ route('distributor.proforma-invoices.upload', $invoice->id) }}"
                                                                method="POST" enctype="multipart/form-data" class="mt-2">
                                                                @csrf
                                                                <input type="file" name="payment_proof" class="form-control mb-2"
                                                                    accept=".pdf,.jpg,.jpeg,.png" required>
                                                                <button type="submit" class="btn btn-warning btn-sm mb-2 w-100">
                                                                    <i class="fas fa-upload"></i> {{ __('messages.upload_remaining_payment_proof') }}
                                                                </button>
                                                                <p class="text-muted">{{ __('messages.remaining_payment') }}
                                                                    Rp{{ number_format($invoice->remaining_payment, 2) }}</p>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </div>

                                                <div class="col-md-6">
                                                    <!-- Download PDF -->
                                                    <a href="{{ asset($invoice->file_path) }}" download
                                                        class="btn btn-success btn-sm mb-2 w-100">
                                                        <i class="fas fa-download"></i> {{ __('messages.download_pdf') }}
                                                    </a>

                                                    <!-- Download DP Proof if exists -->
                                                    @if($invoice->payment_proof_path)
                                                        <a href="{{ asset($invoice->payment_proof_path) }}" download
                                                            class="btn btn-success btn-sm mb-2 w-100">
                                                            <i class="fas fa-download"></i> {{ __('messages.download_dp_proof') }}
                                                        </a>

                                                        <!-- Download Remaining Payment Proof if exists -->
                                                        @if($invoice->second_payment_proof_path)
                                                            <a href="{{ asset($invoice->second_payment_proof_path) }}" download
                                                                class="btn btn-success btn-sm mb-2 w-100">
                                                                <i class="fas fa-download"></i> {{ __('messages.download_remaining_payment_proof') }}
                                                            </a>
                                                        @else
                                                            <form action="{{ route('distributor.proforma-invoices.upload', $invoice->id) }}"
                                                                method="POST" enctype="multipart/form-data" class="mt-2">
                                                                @csrf
                                                                <input type="file" name="payment_proof" class="form-control mb-2"
                                                                    accept=".pdf,.jpg,.jpeg,.png" required>
                                                                <button type="submit" class="btn btn-success btn-sm mb-2 w-100">
                                                                    <i class="fas fa-upload"></i> {{ __('messages.upload_dp_proof') }}
                                                                </button>
                                                                <p class="text-muted">{{ __('messages.dp') }}: Rp{{ number_format($invoice->dp, 2) }}
                                                                    ({{ $invoice->dp_percent }}%)</p>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <form action="{{ route('distributor.proforma-invoices.upload', $invoice->id) }}"
                                                            method="POST" enctype="multipart/form-data" class="mt-2">
                                                            @csrf
                                                            <input type="file" name="payment_proof" class="form-control mb-2"
                                                                accept=".pdf,.jpg,.jpeg,.png" required>
                                                            <button type="submit" class="btn btn-success btn-sm mb-2 w-100">
                                                                <i class="fas fa-upload"></i> {{ __('messages.upload_dp_proof') }}
                                                            </button>
                                                            <p class="text-muted">{{ __('messages.dp') }}: Rp{{ number_format($invoice->dp, 2) }}
                                                                ({{ $invoice->dp_percent }}%)</p>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endsection

<style>
    /* Styling Table */
    .table {
        width: 100%;
        font-size: 1rem;
        text-align: center;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 15px;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: bold;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Button Styles */
    .btn-dark:hover {
        background-color: #343a40;
        color: #fff;
    }

    .btn-info:hover {
        background-color: #17a2b8;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #28a745;
        color: #fff;
    }

    /* Title Styles */
    h3.text-secondary {
        font-weight: 600;
        color: #6c757d;
    }
</style>
