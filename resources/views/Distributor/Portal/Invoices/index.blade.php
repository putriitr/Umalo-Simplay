@extends('layouts.Member.master')

@section('content')

<div class="container mt-5"></div>
<h1 class="text-center mb-4">Daftar Invoice Anda</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
        <li class="breadcrumb-item active text-primary">Daftar Invoice</li>
    </ol>
</div>
<div class="container mt-5">


    <!-- Tabel Invoices -->
    <div class="card shadow-lg border-light rounded">
        <div class="card-body">
            <h3 class="mb-4 text-secondary">Daftar Invoice</h3>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($invoices->isEmpty())
                <div class="alert alert-info">
                    <p>Belum ada Invoice tersedia.</p>
                </div>
            @else
                <div class="mb-3">
                    <a href="{{ route('distributor.proforma-invoices.index') }}" class="btn btn-dark rounded-3">
                        <i class="fas fa-file-invoice"></i> Lihat Proforma Invoices
                    </a>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Invoice Number</th>
                            <th class="text-center">Invoice Date</th>
                            <th class="text-center">Due Date</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">PPN</th>
                            <th class="text-center">Grand Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td class="text-center">{{ $invoice->id }}</td>
                                <td class="text-center">{{ $invoice->invoice_number }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') ?? '-' }}</td>
                                <td class="text-center">{{ number_format($invoice->subtotal, 2) }}</td>
                                <td class="text-center">{{ number_format($invoice->ppn, 2) }}</td>
                                <td class="text-center">{{ number_format($invoice->grand_total_include_ppn, 2) }}</td>
                                <td class="text-center">
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
                                        <a href="{{ asset($invoice->file_path) }}" target="_blank" class="btn btn-info btn-sm w-100 mb-2">
                                            <i class="fas fa-eye"></i> View PDF
                                        </a>
                                        <!-- Tombol untuk mengunduh PDF Invoice -->
                                        <a href="{{ asset($invoice->file_path) }}" download class="btn btn-success btn-sm w-100 mb-2">
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
    </div>
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

    /* Badge for invoice status */
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

    /* Styling button view/download */
    .btn-info, .btn-success {
        font-size: 14px;
        padding: 10px 20px;
        border-radius: 5px;
        text-align: center;
    }

    .d-flex {
        display: flex;
        justify-content: start;
    }

    /* Space between buttons */
    .gap-2 {
        gap: 10px;
    }
</style>
