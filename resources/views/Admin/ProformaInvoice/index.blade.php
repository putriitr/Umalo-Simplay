@extends('layouts.admin.master')
@section('content')
<div class="container mt-5">
    <h2>Daftar Proforma Invoices</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <!-- Cek apakah ada Proforma Invoices -->
    @if($proformaInvoices->isEmpty())
        <div class="alert alert-info">
            <p>Belum ada Proforma Invoice yang tersedia saat ini.</p>
        </div>
    @else
        <!-- Jika ada Proforma Invoices, tampilkan tabelnya -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PI Number</th>
                    <th>PI Date</th>
                    <th>PO Number</th>
                    <th>Distributor</th>
                    <th>Subtotal</th>
                    <th>PPN</th>
                    <th>Grand Total</th>
                    <th>DP</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proformaInvoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->pi_number }}</td>
                        <td>{{ \Carbon\Carbon::parse($invoice->pi_date)->format('d M Y') }}</td>
                        <td>{{ $invoice->purchaseOrder->po_number }}</td>
                        <td>{{ $invoice->purchaseOrder->user->name }}</td>
                        <td>{{ number_format($invoice->subtotal, 2) }}</td>
                        <td>{{ number_format($invoice->ppn, 2) }}</td>
                        <td>{{ number_format($invoice->grand_total_include_ppn, 2) }}</td>
                        <td>{{ number_format($invoice->dp, 2) }}</td>
                        <td>
                            <div class="d-flex flex-column gap-2">
                                <!-- Tombol View dan Download PDF Proforma Invoice -->
                                <a href="{{ asset($invoice->file_path) }}" target="_blank" class="btn btn-info btn-sm mb-1">View PDF</a>
                                <a href="{{ asset($invoice->file_path) }}" download class="btn btn-secondary btn-sm mb-1">Download PDF</a>
                                
                                <!-- Tombol View dan Download Bukti Pembayaran -->
                                @if($invoice->payment_proof_path)
                                    <a href="{{ asset($invoice->payment_proof_path) }}" target="_blank" class="btn btn-success btn-sm mb-1">View Payment Proof</a>
                                    <a href="{{ asset($invoice->payment_proof_path) }}" download class="btn btn-secondary btn-sm mb-1">Download Proof</a>
                                    <a href="{{ route('invoices.create', $invoice->id) }}" class="btn btn-primary btn-sm mt-1">Create Invoice</a>
                                @else
                                    <span class="text-muted mt-1">No Payment Proof</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    @endif
</div>
@endsection