@extends('layouts.admin.master')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        <h1>Daftar Purchase Orders</h1>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <!-- Search Form -->
                <form action="{{ route('admin.purchase-orders.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari berdasarkan nomor PO, distributor, atau status..."
                            value="{{ request()->input('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>PO Number</th>
                                        <th>PO Date</th>
                                        <th>Distributor</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($purchaseOrders as $po)
                                        <tr>
                                            <td>{{ $po->id }}</td>
                                            <td>{{ $po->po_number }}</td>
                                            <td>{{ $po->po_date }}</td>
                                            <td>{{ $po->user->name }}</td>
                                            <td>{{ ucfirst($po->status) }}</td>
                                            <td>
                                                <a href="{{ route('admin.purchase-orders.show', $po->id) }}"
                                                    class="btn btn-info btn-sm">View</a>

                                                @if($po->status === 'pending')
                                                    <form action="{{ route('admin.purchase-orders.approve', $po->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                    </form>

                                                    <form action="{{ route('admin.purchase-orders.reject', $po->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                    </form>
                                                @elseif($po->status === 'approved' && !$po->proformaInvoice)
                                                    <!-- Tampilkan tombol Create Proforma Invoice jika status approved dan belum ada Proforma Invoice -->
                                                    <a href="{{ route('admin.proforma-invoices.create', $po->id) }}"
                                                        class="btn btn-primary btn-sm">Create Proforma Invoice</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">
                                                @if(request()->has('search'))
                                                    Data tidak ditemukan.
                                                @else
                                                    Belum ada Purchase Order.
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $purchaseOrders->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection