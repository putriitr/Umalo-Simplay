@extends('layouts.Member.master')

@section('content')
    <div class="container mt-5">
        <!-- Judul Halaman -->
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Edit Tiket Layanan</h2>
            <p class="text-muted">Perbarui informasi tiket layanan yang Anda ajukan.</p>
        </div>

        <!-- Formulir Edit Tiket Layanan -->
        <div class="card shadow-lg border-light rounded">
            <div class="card-body">
                <h3 class="fw-bold text-secondary">Formulir Edit Tiket Layanan</h3> <br>
                <form action="{{ route('tickets.update', $ticket->id_after_sales) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Textbox Container -->
                    <div class="border p-3 rounded">
                        <!-- Jenis Layanan -->
                        <div class="form-group mb-3">
                            <label for="jenis_layanan" class="form-label"><i class="fas fa-cogs me-2"></i>Jenis Layanan</label>
                            <select name="jenis_layanan" id="jenis_layanan" class="form-control">
                                <option value="Permintaan Data" {{ $ticket->jenis_layanan == 'Permintaan Data' ? 'selected' : '' }}>Permintaan Data</option>
                                <option value="Maintanance" {{ $ticket->jenis_layanan == 'Maintanance' ? 'selected' : '' }}>Maintanance</option>
                                <option value="Visit" {{ $ticket->jenis_layanan == 'Visit' ? 'selected' : '' }}>Visit</option>
                                <option value="Installasi" {{ $ticket->jenis_layanan == 'Installasi' ? 'selected' : '' }}>Installasi</option>
                            </select>
                        </div>

                        <!-- Keterangan Pengajuan -->
                        <div class="form-group mb-3">
                            <label for="keterangan_layanan" class="form-label"><i class="fas fa-info-circle me-2"></i>Keterangan Pengajuan</label>
                            <textarea name="keterangan_layanan" id="keterangan_layanan" class="form-control" rows="4" placeholder="Deskripsikan perubahan yang diperlukan...">{{ $ticket->keterangan_layanan }}</textarea>
                        </div>

                        <!-- Dokumen Pendukung -->
                        <div class="form-group mb-4">
                            <label for="file_pendukung_layanan" class="form-label"><i class="fas fa-paperclip me-2"></i>Dokumen Pendukung (Opsional)</label>
                            <input type="file" name="file_pendukung_layanan" id="file_pendukung_layanan" class="form-control">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-start gap-3 mt-4">
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-save me-2"></i>Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
