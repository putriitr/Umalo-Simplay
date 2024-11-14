@extends('layouts.admin.master')
@section('content')
<div class="container mt-5">
    <h2>Detail Purchase Order #{{ $purchaseOrder->po_number }}</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Purchase Order Information</h5>
            <p><strong>PO Number:</strong> {{ $purchaseOrder->po_number }}</p>
            <p><strong>PO Date:</strong> {{ $purchaseOrder->po_date }}</p>
            <p><strong>Distributor:</strong> {{ $purchaseOrder->user->name }}</p>
            <p><strong>Status:</strong> {{ ucfirst($purchaseOrder->status) }}</p>
            @if($purchaseOrder->file_path)
                <p><strong>Attached File:</strong> 
                    <a href="{{ asset($purchaseOrder->file_path) }}" target="_blank" class="btn btn-primary">View File</a>
                </p>
            @else
                <p><strong>Attached File:</strong> <span class="text-muted">No file uploaded</span></p>
            @endif
        </div>
    </div>
    <a href="{{ route('admin.purchase-orders.index') }}" class="btn btn-secondary">Back to PO List</a>
</div>
@endsection