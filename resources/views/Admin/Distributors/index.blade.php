@extends('layouts.admin.master')
@section('content')
<div class="container py-5">
    <h2 class="mb-4">Daftar Distributor</h2>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($distributors as $key => $distributor)
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection