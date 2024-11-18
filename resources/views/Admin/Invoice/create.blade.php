@extends('layouts.admin.master')
@section('content')
<div class="container mt-5">
    <h2>Buat Invoice untuk Proforma Invoice #{{ $proformaInvoice->pi_number }}</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('invoices.store', $proformaInvoice->id) }}" method="POST">
        @csrf
        <!-- Nomor Invoice -->
        <div class="mb-3">
            <label for="invoice_number" class="form-label">Invoice Number</label>
            <input type="text" class="form-control" id="invoice_number" name="invoice_number" required>
        </div>
        <!-- Tanggal Invoice -->
        <div class="mb-3">
            <label for="invoice_date" class="form-label">Invoice Date</label>
            <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
        </div>
        <!-- Tanggal Jatuh Tempo -->
        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" class="form-control" id="due_date" name="due_date">
        </div>
        <!-- Subtotal, PPN, dan Grand Total dari Proforma Invoice -->
        <div class="mb-3">
            <label class="form-label">Subtotal</label>
            <input type="number" class="form-control" value="{{ $subtotal }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">PPN (%)</label>
            <input type="number" class="form-control" value="{{ $ppn }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Grand Total (Include PPN)</label>
            <input type="number" class="form-control" value="{{ $grandTotalIncludePPN }}" readonly>
        </div>
        <!-- Informasi Vendor -->
        <h4>Vendor Information</h4>
        <div class="mb-3">
            <label for="vendor_name" class="form-label">Vendor Name</label>
            <input type="text" class="form-control" id="vendor_name" name="vendor_name" value="{{ $user->name }}" readonly>
        </div>
        
        <div class="mb-3">
            <label for="vendor_address" class="form-label">Vendor Address</label>
            <textarea class="form-control" id="vendor_address" name="vendor_address" rows="2" readonly>{{ $user->alamat }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="vendor_phone" class="form-label">Vendor Phone</label>
            <input type="text" class="form-control" id="vendor_phone" name="vendor_phone" value="{{ $user->no_telp }}" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Invoice</button>
    </form>
</div>
@endsection