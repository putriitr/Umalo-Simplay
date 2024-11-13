@extends('layouts.Admin.master')
@section('content')
<div class="container py-5">
    <h2 class="mb-4">Daftar Permintaan Quotation</h2>
    @if(session('success'))
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
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Distributor</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotations as $key => $quotation)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $quotation->produk->nama ?? 'Produk tidak tersedia' }}</td>
                            <td>{{ $quotation->user->name ?? 'Tidak ada pengguna' }}</td>
                            <td>{{ $quotation->quantity }}</td>
                            <td>
                                <span class="badge 
                                    @if($quotation->status == 'pending') bg-warning 
                                    @elseif($quotation->status == 'approved') bg-success 
                                    @elseif($quotation->status == 'rejected') bg-secondary 
                                    @endif">
                                    {{ ucfirst($quotation->status) }}
                                </span>
                            </td>
                            <td>
                                @if($quotation->file_path)
                                    <a href="{{ asset('storage/' . $quotation->file_path) }}" target="_blank" class="btn btn-link">Download File</a>
                                @else
                                    <span class="text-muted">No file</span>
                                @endif
                            </td>
                            <td>
                                <!-- Status Update Form -->
                                <form action="{{ route('admin.quotations.updateStatus', $quotation->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm d-inline" onchange="this.form.submit()" style="width: auto;">
                                        <option value="pending" {{ $quotation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $quotation->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $quotation->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                                <!-- File Upload Form -->
                                <form action="{{ route('admin.quotations.uploadFile', $quotation->id) }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                                    @csrf
                                    <input type="file" name="file" class="form-control form-control-sm d-inline" style="width: auto;" onchange="this.form.submit()">
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada permintaan quotation.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection