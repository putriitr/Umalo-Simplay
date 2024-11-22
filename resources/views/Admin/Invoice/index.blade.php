@extends('layouts.admin.master')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        <h1>Daftar Invoices</h1>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
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
                                    @forelse ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->invoice_date }}</td>
                                            <td>{{ $invoice->due_date }}</td>
                                            <td>{{ number_format($invoice->subtotal, 2) }}</td>
                                            <td>{{ number_format($invoice->ppn, 2) }}</td>
                                            <td>{{ number_format($invoice->grand_total_include_ppn, 2) }}</td>
                                            <td>{{ ucfirst($invoice->status) }}</td>
                                            <td>
                                                <a href="{{ asset($invoice->file_path) }}" target="_blank"
                                                    class="btn btn-info btn-sm">View PDF</a>
                                                <a href="{{ asset($invoice->file_path) }}" download
                                                    class="btn btn-secondary btn-sm">Download PDF</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">Belum ada Invoice.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection