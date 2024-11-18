@extends('layouts.Member.master')  
@section('content')

<style>
    /* Efek perubahan warna tombol saat hover menjadi abu-abu */
    .btn:hover {
        background-color: #d3d3d3;
        /* Warna abu-abu */
        color: #333;         
    }

    /* Efek hover untuk tombol */
    .btn-dark:hover {
        background-color: #343a40;
        color: #fff;
    }

    .btn-dark.rounded-3 {
        border-radius: 15px;
    }

    h2.text-center {
        margin-bottom: 30px; 
    }
</style>

<div class="container mt-5">
    <h2 class="text-center text-dark">Daftar Proforma Invoices Anda</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($proformaInvoices->isEmpty())
        <div class="alert alert-info">
            <p>Belum ada Proforma Invoice tersedia.</p>
            <p>Silakan buat Purchase Order (PO) terlebih dahulu untuk memulai proses.</p>
            <a href="{{ route('distributor.purchase-orders.index') }}" class="btn btn-warning w-100">Lihat Purchase Orders</a>
        </div>
    @else
        <div class="mb-3">
            <a href="{{ route('distributor.invoices.index') }}" class="btn btn-dark rounded-3">Lihat Invoices</a>
        </div>

        <table class="table table-bordered table-hover table-striped">
            <thead class="bg-info text-white">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">PI Number</th>
                    <th class="text-center">PI Date</th>
                    <th class="text-center">PO Number</th>
                    <th class="text-center">Subtotal</th>
                    <th class="text-center">PPN</th>
                    <th class="text-center">Grand Total</th>
                    <th class="text-center">DP</th>
                    <th class="text-center">Remaining Payment</th>
                    <th class="text-center">Actions</th>
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
                                    <a href="{{ asset($invoice->file_path) }}" target="_blank"
                                        class="btn btn-info btn-sm mb-2 w-100">
                                        <i class="fas fa-eye"></i> View PDF
                                    </a>

                                    @if($invoice->payment_proof_path)
                                        <a href="{{ asset($invoice->payment_proof_path) }}" target="_blank"
                                            class="btn btn-info btn-sm mb-2 w-100">
                                            <i class="fas fa-eye"></i> View DP Proof
                                        </a>

                                        @if($invoice->second_payment_proof_path)
                                            <a href="{{ asset($invoice->second_payment_proof_path) }}" target="_blank"
                                                class="btn btn-info btn-sm mb-2 w-100">
                                                <i class="fas fa-eye"></i> View Remaining Payment Proof
                                            </a>
                                        @else
                                            <form action="{{ route('distributor.proforma-invoices.upload', $invoice->id) }} "
                                                method="POST" enctype="multipart/form-data" class="mt-2">
                                                @csrf
                                                <input type="file" name="payment_proof" class="form-control mb-2"
                                                    accept=".pdf,.jpg,.jpeg,.png" required>
                                                <button type="submit" class="btn btn-warning btn-sm mb-2 w-100">
                                                    <i class="fas fa-upload"></i> Upload Remaining Payment Proof
                                                </button>
                                                <p class="text-muted">Remaining Payment:
                                                    Rp{{ number_format($invoice->remaining_payment, 2) }}</p>
                                            </form>
                                        @endif
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ asset($invoice->file_path) }}" download
                                        class="btn btn-success btn-sm mb-2 w-100">
                                        <i class="fas fa-download"></i> Download PDF
                                    </a>

                                    @if($invoice->payment_proof_path)
                                        <a href="{{ asset($invoice->payment_proof_path) }}" download
                                            class="btn btn-success btn-sm mb-2 w-100">
                                            <i class="fas fa-download"></i> Download DP Proof
                                        </a>

                                        @if($invoice->second_payment_proof_path)
                                            <a href="{{ asset($invoice->second_payment_proof_path) }}" download
                                                class="btn btn-success btn-sm mb-2 w-100">
                                                <i class="fas fa-download"></i> Download Remaining Payment Proof
                                            </a>
                                        @else
                                            <form action="{{ route('distributor.proforma-invoices.upload', $invoice->id) }} "
                                                method="POST" enctype="multipart/form-data" class="mt-2">
                                                @csrf
                                                <input type="file" name="payment_proof" class="form-control mb-2"
                                                    accept=".pdf,.jpg,.jpeg,.png" required>
                                                <button type="submit" class="btn btn-warning btn-sm mb-2 w-100">
                                                    <i class="fas fa-upload"></i> Upload Remaining Payment Proof
                                                </button>
                                                <p class="text-muted">Remaining Payment:
                                                    Rp{{ number_format($invoice->remaining_payment, 2) }}</p>
                                            </form>
                                        @endif
                                    @else
                                        <form action="{{ route('distributor.proforma-invoices.upload', $invoice->id) }} "
                                            method="POST" enctype="multipart/form-data" class="mt-2">
                                            @csrf
                                            <input type="file" name="payment_proof" class="form-control mb-2"
                                                accept=".pdf,.jpg,.jpeg,.png" required>
                                            <button type="submit" class="btn btn-success btn-sm mb-2 w-100">
                                                <i class="fas fa-upload"></i> Upload DP Proof
                                            </button>
                                            <p class="text-muted">DP: Rp{{ number_format($invoice->dp, 2) }}
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
    @endif
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endsection
