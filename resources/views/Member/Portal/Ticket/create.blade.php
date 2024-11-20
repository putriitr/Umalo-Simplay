@extends('layouts.Member.master')

@section('content')

<div class="container mt-5">
    <!-- Title -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Buat Tiket Layanan Baru</h2>
        <p class="text-muted">Isi formulir berikut untuk mengajukan tiket layanan yang Anda butuhkan.</p>
    </div>

    <!-- Form Card -->
    <div class="card shadow-lg border-light rounded">
        <div class="card-body">
            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Jenis Layanan -->
                <div class="mb-4">
                    <label for="jenis_layanan" class="form-label">Jenis Layanan</label>
                    <select name="jenis_layanan" id="jenis_layanan" class="form-control">
                        <option value="Permintaan Data">Permintaan Data</option>
                        <option value="Maintanance">Maintanance</option>
                        <option value="Visit">Visit</option>
                        <option value="Installasi">Installasi</option>
                    </select>
                </div>

                <!-- Keterangan Layanan -->
                <div class="mb-4">
                    <label for="keterangan_layanan" class="form-label">Keterangan Pengajuan</label>
                    <textarea name="keterangan_layanan" id="keterangan_layanan" class="form-control" rows="4"
                        placeholder="Deskripsikan layanan yang Anda butuhkan..."></textarea>
                </div>

                <!-- Dokumen Pendukung -->
                <div class="mb-4">
                    <label for="file_pendukung_layanan" class="form-label">Dokumen Pendukung (Opsional)</label>
                    <input type="file" name="file_pendukung_layanan" id="file_pendukung_layanan" class="form-control">
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-start">
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bx bx-x-circle me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bx bx-paper-plane me-2"></i>Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<!-- Custom Styles -->
<style>
    /* Minimalistic Form Styling */
    .card-body {
        padding: 2rem;
    }

    .form-control {
        border-radius: 10px;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #007bff;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    .btn-outline-secondary {
        border-radius: 10px;
        border: 1px solid #6c757d;
        color: #6c757d;
    }

    .btn-primary {
        border-radius: 10px;
        background-color: #007bff;
        border: 1px solid #007bff;
        color: white;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        color: white;
    }

    /* Adjust spacing for inputs */
    .mb-4 {
        margin-bottom: 1.5rem;
    }
</style>
