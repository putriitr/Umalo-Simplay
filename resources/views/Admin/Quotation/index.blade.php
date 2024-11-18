@extends('layouts.Admin.master') 

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Daftar Permintaan Quotation</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="bg-lightblue text-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Distributor</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotations as $key => $quotation)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $quotation->nomor_pengajuan ?? 'Nomor tidak tersedia' }}</td>
                            <td>
                                @foreach ($quotation->quotationProducts as $product)
                                    <div>- {{ $product->equipment_name ?? 'Produk tidak tersedia' }}</div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($quotation->quotationProducts as $product)
                                    <div>{{ $product->quantity }}</div>
                                @endforeach
                            </td>
                            <td>
                                <span class="badge 
                                    @if ($quotation->status === 'cancelled') bg-danger 
                                    @elseif($quotation->status === 'quotation') bg-success
                                    @else bg-warning 
                                    @endif">
                                    {{ ucfirst($quotation->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.quotations.show', $quotation->id) }}" class="btn btn-softblue btn-sm">View</a>
                                    @if ($quotation->status !== 'cancelled')
                                        <a href="{{ route('admin.quotations.edit', $quotation->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada permintaan quotation.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

<style>
    .bg-lightblue {
        background-color: #b3d9ff; /* Soft light blue */
    }

    .table th {
        text-align: center;
        padding: 15px;
        background-color: #b3d9ff; /* Soft light blue */
    }

    .table td {
        padding: 15px;
        vertical-align: middle;
    }

    .badge {
        font-size: 14px;
        padding: 5px 10px;
    }

    .badge-success {
        background-color: #28a745; /* Green for quotation */
    }

    .badge-danger {
        background-color: #dc3545; /* Red for cancelled */
    }

    .badge-warning {
        background-color: #ffc107; /* Yellow for other status */
    }

    .btn-softblue {
        background-color: #b3d9ff; /* Soft light blue */
        color: #333;
        font-size: 14px;
        padding: 8px 16px;
        border-radius: 5px;
        width: 100px;
        text-align: center;
    }

    .btn-softblue:hover {
        background-color: #99c2ff;
    }

    .btn-secondary {
        background-color: #6c757d; /* Grey for edit */
        color: white;
        font-size: 14px;
        padding: 8px 16px;
        border-radius: 5px;
        width: 100px;
        text-align: center;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* Additional styling for alerts */
    .alert {
        border-radius: 5px;
    }

    .alert .btn-close {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>
