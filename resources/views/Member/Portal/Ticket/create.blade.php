@extends('layouts.Member.master')
@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Buat Tiket Layanan Baru</h1>
</div>


<div class="container py-5">
    <div class="card shadow-sm border-0 rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Formulir Pengajuan Tiket Layanan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="jenis_layanan" class="form-label"><i class="fas fa-cogs me-2"></i>Jenis Layanan</label>
                    <select name="jenis_layanan" id="jenis_layanan" class="form-control">
                        <option value="Permintaan Data">Permintaan Data</option>
                        <option value="Maintanance">Maintanance</option>
                        <option value="Visit">Visit</option>
                        <option value="Installasi">Installasi</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="keterangan_layanan" class="form-label"><i class="fas fa-info-circle me-2"></i>Keterangan
                        Pengajuan</label>
                    <textarea name="keterangan_layanan" id="keterangan_layanan" class="form-control" rows="4"
                        placeholder="Deskripsikan layanan yang Anda butuhkan..."></textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="file_pendukung_layanan" class="form-label"><i class="fas fa-paperclip me-2"></i>Dokumen
                        Pendukung (Opsional)</label>
                    <input type="file" name="file_pendukung_layanan" id="file_pendukung_layanan" class="form-control">
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('tickets.index') }}" class="btn btn-danger me-md-2" data-bs-toggle="tooltip"
                        title="Batal">
                        <i class="fas fa-times-circle"></i>
                    </a>

                    <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" title="Kirim">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>


            </form>
        </div>
    </div>
    <script>
// Aktifkan tooltip di seluruh halaman
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});


    </script>
    @endsection