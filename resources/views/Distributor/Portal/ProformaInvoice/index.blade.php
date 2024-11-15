@extends('layouts.Member.master')
@section('content')
   <!-- Header Start -->
   <div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Daftar Proforma Invoices</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Daftar Proforma Invoices</li>
        </ol>
    </div>
</div>
<!-- Header End --><br><br>
    <div class="container mt-5">
        <h2>Daftar Proforma Invoices Anda</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <!-- Cek apakah ada Proforma Invoices -->
        @if ($proformaInvoices->isEmpty())
            <div class="alert alert-info">
                <p>Belum ada Proforma Invoice tersedia.</p>
                <p>Silakan buat Purchase Order (PO) terlebih dahulu untuk memulai proses.</p>
                <a href="{{ route('distributor.purchase-orders.index') }}" class="btn btn-primary">Lihat Purchase Orders</a>
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
                            <td>{{ number_format($invoice->subtotal, 2) }}</td>
                            <td>{{ number_format($invoice->ppn, 2) }}</td>
                            <td>{{ number_format($invoice->grand_total_include_ppn, 2) }}</td>
                            <td>{{ number_format($invoice->dp, 2) }}</td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <!-- Tautan untuk View dan Download PDF Proforma Invoice -->
                                    <a href="{{ asset($invoice->file_path) }}" target="_blank" class="btn btn-info btn-sm">View PDF</a>
                                    <a href="{{ asset($invoice->file_path) }}" download class="btn btn-secondary btn-sm">Download PDF</a>
                
                                    <!-- Cek apakah ada bukti pembayaran -->
                                    @if($invoice->payment_proof_path)
                                        <!-- Tampilkan tombol View dan Download Bukti Pembayaran jika sudah diunggah -->
                                        <a href="{{ asset($invoice->payment_proof_path) }}" target="_blank" class="btn btn-success btn-sm">View Payment Proof</a>
                                        <a href="{{ asset($invoice->payment_proof_path) }}" download class="btn btn-secondary btn-sm">Download Payment Proof</a>
                                    @else
                                        <!-- Form untuk Upload Bukti Pembayaran jika belum ada -->
                                        <form action="{{ route('distributor.proforma-invoices.upload', $invoice->id) }}" method="POST" enctype="multipart/form-data" class="mt-2">
                                            @csrf
                                            <input type="file" name="payment_proof" class="form-control mb-2" accept=".pdf,.jpg,.jpeg,.png" required>
                                            <button type="submit" class="btn btn-success btn-sm">Upload Bukti Pembayaran</button>
                                        </form>
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