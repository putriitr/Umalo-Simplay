@extends('layouts.admin.master')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        <h1>Daftar Proforma Invoices</h1>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Search Form -->
                <form action="{{ route('admin.proforma-invoices.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari berdasarkan nomor PI, PO, atau distributor..."
                            value="{{ request()->input('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>

                <!-- Jika tidak ada Proforma Invoices -->
                @if ($proformaInvoices->isEmpty() && !request()->has('search'))
                    <!-- Jika tidak ada Proforma Invoices sama sekali -->
                    <div class="alert alert-info text-center">
                        <p class="mb-3">Belum ada Proforma Invoice yang tersedia saat ini.</p>
                    </div>
                @else
                    <!-- Tabel Proforma Invoices -->
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">PI Number</th>
                                            <th class="text-center">PI Date</th>
                                            <th class="text-center">PO Number</th>
                                            <th class="text-center">Distributor</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">PPN</th>
                                            <th class="text-center">Grand Total</th>
                                            <th class="text-center">DP</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #f9f9f9;">
                                        @forelse($proformaInvoices as $invoice)
                                            <tr>
                                                <td class="text-center">{{ $invoice->id }}</td>
                                                <td class="text-center">{{ $invoice->pi_number }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($invoice->pi_date)->format('d M Y') }}
                                                </td>
                                                <td class="text-center">{{ $invoice->purchaseOrder->po_number }}</td>
                                                <td class="text-center">{{ $invoice->purchaseOrder->user->name }}</td>
                                                <td class="text-center">Rp{{ number_format($invoice->subtotal, 2) }}</td>
                                                <td class="text-center">Rp{{ number_format($invoice->ppn, 2) }}</td>
                                                <td class="text-center">
                                                    Rp{{ number_format($invoice->grand_total_include_ppn, 2) }}
                                                </td>
                                                <td class="text-center">Rp{{ number_format($invoice->dp, 2) }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-column gap-2">
                                                        <!-- View & Download PDF -->
                                                        <a href="{{ asset($invoice->file_path) }}" target="_blank"
                                                            class="btn btn-info btn-sm rounded-pill shadow-sm">
                                                            <i class="fas fa-file-pdf"></i> View PDF
                                                        </a>
                                                        <a href="{{ asset($invoice->file_path) }}" download
                                                            class="btn btn-secondary btn-sm rounded-pill shadow-sm">
                                                            <i class="fas fa-download"></i> Download PDF
                                                        </a>
                                                        <!-- Payment Proof -->
                                                        @if ($invoice->payment_proof_path)
                                                            <a href="{{ asset($invoice->payment_proof_path) }}" target="_blank"
                                                                class="btn btn-success btn-sm rounded-pill shadow-sm">
                                                                <i class="fas fa-receipt"></i> View Payment Proof
                                                            </a>
                                                            <a href="{{ asset($invoice->payment_proof_path) }}" download
                                                                class="btn btn-secondary btn-sm rounded-pill shadow-sm">
                                                                <i class="fas fa-download"></i> Download Payment Proof
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Payment Proof Not Available</span>
                                                        @endif

                                                        <!-- Create Invoice -->
                                                        @if (in_array($invoice->status, ['partially_paid', 'paid']))
                                                            <a href="{{ route('invoices.create', $invoice->id) }}"
                                                                class="btn btn-primary btn-sm rounded-pill shadow-sm mt-1">
                                                                <i class="fas fa-plus"></i> Create Invoice
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center text-muted">Data tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $proformaInvoices->links('pagination::bootstrap-4') }}
                            </div>
                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection