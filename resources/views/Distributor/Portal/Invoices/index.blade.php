@extends('layouts.Member.master')
@section('content')


<!-- Main Content -->
<div class="container mt-5">
    <h1 class="text-center text-dark mb-4">Daftar Invoice Anda</h1> <BR> <BR>

    @if ($invoices->isEmpty())
        <div class="alert alert-info text-center">
            <p>Belum ada Invoice tersedia.</p>
        </div>
    @else
        <table class="table table-bordered table-hover table-striped">
            <thead class="bg-lightblue text-dark">
                <tr>
                    <th>ID</th>
                    <th>Invoice Number</th>
                    <th>Invoice Date</th>
                    <th>Due Date</th>
                    <th>Subtotal</th>
                    <th>PPN</th>
                    <th>Grand Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->invoice_number }}</td>
                        <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') ?? '-' }}</td>
                        <td>{{ number_format($invoice->subtotal, 2) }}</td>
                        <td>{{ number_format($invoice->ppn, 2) }}</td>
                        <td>{{ number_format($invoice->grand_total_include_ppn, 2) }}</td>
                        <td>
                            <!-- Badge untuk Status -->
                            <span class="badge 
                                @if($invoice->status == 'paid') badge-success 
                                @elseif($invoice->status == 'unpaid') badge-danger 
                                @elseif($invoice->status == 'partial') badge-warning
                                @else badge-secondary @endif">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-start gap-2">
                                <!-- Tombol untuk melihat PDF Invoice -->
                                <a href="{{ asset($invoice->file_path) }}" target="_blank" class="btn btn-softblue btn-sm">
                                    <i class="fas fa-eye"></i> View PDF
                                </a>
                                <!-- Tombol untuk mengunduh PDF Invoice -->
                                <a href="{{ asset($invoice->file_path) }}" download class="btn btn-success btn-sm">
                                    <i class="fas fa-download"></i> Download PDF
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Styling Tambahan -->
<style>
    .bg-breadcrumb {
        background-color: #17a2b8;
    }

    .breadcrumb-item a {
        color: #fff;
    }

    .breadcrumb-item.active {
        color: #fff;
    }

    .table th {
        text-align: center;
    }

    .table td {
        vertical-align: middle;
    }

    .table th, .table td {
        padding: 15px;
    }

    /* Styling untuk tombol */
    .btn-softblue {
        background-color: #b3d9ff; /* Biru soft */
        color: #333;
        font-size: 14px;
        padding: 8px 16px;
        border-radius: 5px;
        width: 150px; /* Membuat lebar tombol konsisten */
        text-align: center;
    }

    .btn-softblue:hover {
        background-color: #99c2ff;
    }

    .btn-success {
        background-color: #28a745; /* Hijau */
        color: white;
        font-size: 14px;
        padding: 8px 16px;
        border-radius: 5px;
        width: 150px;
        text-align: center;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    /* Badge untuk status invoice */
    .badge {
        font-size: 14px;
        padding: 5px 10px;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    .badge-warning {
        background-color: #ffc107;
    }

    .badge-secondary {
        background-color: #6c757d;
    }

    /* Mengganti warna background header tabel menjadi biru muda soft */
    .bg-lightblue {
        background-color: #b3d9ff; /* Soft light blue */
    }

    /* Untuk tombol-tombol supaya tetap rata kiri dan konsisten */
    .d-flex {
        display: flex;
        justify-content: start;
    }

    /* Margin pada tabel */
    .table {
        margin-top: 20px;
    }

</style>

<!-- FontAwesome CDN untuk ikon tombol -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endsection
