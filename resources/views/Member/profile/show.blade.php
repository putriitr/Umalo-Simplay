@extends('layouts.Member.master')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Wrapper for User Profile -->
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Card Header -->
                <div class="card-header bg-light text-dark text-center py-4 rounded-top d-flex align-items-center justify-content-center gap-2">
                    <i class="fa fa-user-circle text-primary fs-1"></i>
                    <h2 class="mb-0">Profil Pengguna</h2>
                </div>
                <!-- Card Body -->
                <div class="card-body p-5">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center text-dark bg-light">Informasi Profil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-dark">Nama:</td>
                                    <td class="text-muted">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Email:</td>
                                    <td class="text-muted">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Nama Perusahaan:</td>
                                    <td class="text-muted">{{ $user->nama_perusahaan ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Bidang Perusahaan:</td>
                                    <td class="text-muted">{{ $user->bidangPerusahaan->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Nomor Telepon:</td>
                                    <td class="text-muted">{{ $user->no_telp ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Alamat:</td>
                                    <td class="text-muted">{{ $user->alamat ?? 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Card Footer -->
                <div class="card-footer text-center bg-light py-4 rounded-bottom">
                    @if (auth()->check())
                        <a href="{{ auth()->user()->type === 'member' ? route('profile.edit') : route('distributor.profile.edit') }}" 
                           class="btn btn-outline-primary px-4 py-2 rounded-pill shadow-sm transition-all duration-300 hover:bg-primary">
                           <i class="fa fa-edit me-2"></i>Edit Profil
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
