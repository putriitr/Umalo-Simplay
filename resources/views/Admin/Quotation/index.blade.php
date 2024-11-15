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
                            <!-- Menampilkan Nama Produk -->
                            <td>
                                @foreach ($quotation->quotationProducts as $product)
                                    <div>- {{ $product->equipment_name ?? 'Produk tidak tersedia' }}</div>
                                @endforeach
                            </td>
                            <!-- Menampilkan Distributor -->
                            <td>{{ $quotation->user->name ?? 'Tidak ada pengguna' }}</td>
                            <!-- Menampilkan Quantity untuk setiap produk -->
                            <td>
                                @foreach ($quotation->quotationProducts as $product)
                                    <div>{{ $product->quantity }}</div>
                                @endforeach
                            </td>
                            <!-- Status berdasarkan status di database -->
                            <td>
                                <span class="badge 
                                            @if ($quotation->status === 'cancelled') bg-danger
                                            @elseif($quotation->status === 'quotation') bg-success
                                                @else bg-warning 
                                            @endif">
                                    {{ ucfirst($quotation->status) }}
                                </span>
                            </td>
                            <!-- Menampilkan Dokumen PDF jika ada -->
                            <td>
                                @if ($quotation->pdf_path)
                                    <div class="d-flex flex-column">
                                        <a href="{{ asset($quotation->pdf_path) }}" target="_blank" class="text-primary mb-1">
                                            <i class="fas fa-file-alt me-2"></i>Lihat Dokumen PDF
                                        </a>

                                        <a href="{{ asset($quotation->pdf_path) }}" download class="text-secondary">
                                            <i class="fas fa-download me-2"></i>Download PDF
                                        </a>
                                    </div>
                                @else
                                    <span class="text-muted">No file</span>
                                @endif
                            </td>
                            <!-- Actions -->
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.quotations.show', $quotation->id) }}"
                                        class="btn btn-primary btn-sm">View</a>
                                    @if ($quotation->status !== 'cancelled')
                                        <a href="{{ route('admin.quotations.edit', $quotation->id) }}"
                                            class="btn btn-secondary btn-sm">Edit</a>
                                    @endif
                                </div>
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