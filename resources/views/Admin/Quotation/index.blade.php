@extends('layouts.Admin.master') 

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        <h1>Daftar Permintaan Quotation</h1>
                    </div>
                </div>


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
                

                <div class="card-body">
                    <!-- Search Form -->
                <form action="{{ route('admin.quotations.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari berdasarkan nomor pengajuan, distributor, produk, atau status..."
                            value="{{ request()->input('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Pengajuan</th>
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
                                                            <td class="text-center">{{ $quotations->firstItem() + $key }}</td>
                                                            <td>{{ $quotation->nomor_pengajuan ?? 'Nomor tidak tersedia' }}</td>
                                                            <td>
                                                                @if ($quotation->quotationProducts)
                                                                    @foreach ($quotation->quotationProducts as $product)
                                                                        <div>- {{ $product->equipment_name ?? 'Produk tidak tersedia' }}</div>
                                                                    @endforeach
                                                                @else
                                                                    <div>Produk tidak tersedia</div>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{ $quotation->user->name ?? 'Tidak ada pengguna' }}
                                                            </td>
                                                            <td>
                                                                @if ($quotation->quotationProducts)
                                                                    @foreach ($quotation->quotationProducts as $product)
                                                                        <div class="text-center">{{ $product->quantity }}</div>
                                                                    @endforeach
                                                                @else
                                                                    <div>0</div>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge 
                                        @if ($quotation->status === 'cancelled') bg-danger
                                        @elseif($quotation->status === 'quotation') bg-success
                                        @else bg-warning @endif">
                                                                    {{ ucfirst($quotation->status) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-2">
                                                                    <a href="{{ route('admin.quotations.show', $quotation->id) }}"
                                                                        class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                                                        <i class="fas fa-eye me-1"></i> View
                                                                    </a>
                                                                    @if ($quotation->status !== 'cancelled')
                                                                        <a href="{{ route('admin.quotations.edit', $quotation->id) }}"
                                                                            class="btn btn-secondary btn-sm rounded-pill shadow-sm">
                                                                            <i class="fas fa-edit"></i> Edit
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum ada permintaan quotation.
                                            </td>
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

<style>
    .bg-lightblue {
        background-color: #b3d9ff;
        /* Soft light blue */
    }

    .table th {
        text-align: center;
        padding: 15px;
        background-color: #b3d9ff;
        /* Soft light blue */
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
        background-color: #28a745;
        /* Green for quotation */
    }

    .badge-danger {
        background-color: #dc3545;
        /* Red for cancelled */
    }

    .badge-warning {
        background-color: #ffc107;
        /* Yellow for other status */
    }

    .btn-softblue {
        background-color: #b3d9ff;
        /* Soft light blue */
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
        background-color: #6c757d;
        /* Grey for edit */
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