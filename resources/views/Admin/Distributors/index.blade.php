@extends('layouts.admin.master')  
@section('content')
<div class="container py-5">
    {{-- Card Wrapper --}}
    <div class="card shadow-sm border-0 rounded">
        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="card-title mb-0">Daftar Member</h1>
        </div>

        {{-- Card Body --}}
        <div class="card-body">
            {{-- Flash Messages --}}
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

            {{-- Distributor Table --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    {{-- Table Header --}}
                    <thead class="table-primary">
                        <tr>
                            <th class="table-title">No</th>
                            <th class="table-title">Name</th>
                            <th class="table-title">Email</th>
                            <th class="table-title">Company</th>
                            <th class="table-title">Status</th>
                            <th class="table-title">Action</th>
                        </tr>
                    </thead>
                    {{-- Table Body --}}
                    <tbody class="table-body">
                        @forelse($distributors as $key => $distributor)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $distributor->name }}</td>
                                <td>{{ $distributor->email }}</td>
                                <td>{{ $distributor->nama_perusahaan }}</td>
                                <td>
                                    <span class="badge 
                                        @if($distributor->verified) bg-success 
                                        @else bg-warning @endif">
                                        {{ $distributor->verified ? 'Approved' : 'Pending' }}
                                    </span>
                                </td>
                                <td>
                                    @if(!$distributor->verified)
                                        <form action="{{ route('admin.distributors.approve', $distributor->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check me-1"></i>Approve
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            <i class="fas fa-check-circle me-1"></i>Approved
                                        </button>
                                    @endif
                                    <a href="{{ route('admin.distributors.show', $distributor->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data distributor tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Additional Style --}}
<style>
    /* Pastikan header tabel (th) berwarna hitam */
    .table-primary th {
        color: black !important;
    }

    /* Pastikan isi tabel (td) berwarna abu-abu */
    .table-body td {
        color: #6c757d !important; /* Warna abu */
    }
</style>

@endsection
