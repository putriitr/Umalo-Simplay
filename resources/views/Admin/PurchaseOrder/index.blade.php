@extends('layouts.admin.master')
@section('content')
<div class="container mt-5">
    <h2>Daftar Purchase Orders</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
        <thead>
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
            @foreach($purchaseOrders as $po)
                <tr>
                    <td>{{ $po->id }}</td>
                    <td>{{ $po->po_number }}</td>
                    <td>{{ $po->po_date }}</td>
                    <td>{{ $po->user->name }}</td>
                    <td>{{ ucfirst($po->status) }}</td>
                    <td>
                        <a href="{{ route('admin.purchase-orders.show', $po->id) }}" class="btn btn-info btn-sm">View</a>
                        
                        @if($po->status === 'pending')
                            <form action="{{ route('admin.purchase-orders.approve', $po->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            
                            <form action="{{ route('admin.purchase-orders.reject', $po->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection