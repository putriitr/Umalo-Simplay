@extends('layouts.Member.master')

@section('content')
    <div class="container mt-5">
        <!-- Judul Halaman -->
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Detail Tiket Layanan</h2>
            <p class="text-muted">Lihat detail informasi tiket layanan yang Anda ajukan.</p>
        </div>

        <!-- Tabel Detail Tiket Layanan -->
        <div class="card shadow-lg border-light rounded">
            <div class="card-body">
                <h3 class="mb-4 text-secondary">Informasi Tiket Layanan</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><i class="fas fa-cogs me-2"></i>Jenis Layanan:</th>
                            <td>{{ $ticket->jenis_layanan }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-info-circle me-2"></i>Keterangan Pengajuan:</th>
                            <td>{{ $ticket->keterangan_layanan }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-calendar-alt me-2"></i>Tanggal Pengajuan:</th>
                            <td>{{ \Carbon\Carbon::parse($ticket->tgl_pengajuan)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-clipboard-check me-2"></i>Status:</th>
                            <td>
                                <span class="badge 
                                    @if($ticket->status == 'open') bg-success 
                                    @elseif($ticket->status == 'progress') bg-warning 
                                    @else bg-secondary @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                        </tr>
                        @if ($ticket->file_pendukung_layanan)
                            <tr>
                                <th><i class="fas fa-paperclip me-2"></i>Dokumen Pendukung:</th>
                                <td><a href="{{ asset($ticket->file_pendukung_layanan) }}" target="_blank" class="text-primary">Lihat Dokumen</a></td>
                            </tr>
                        @endif
                        <tr>
                            <th><i class="fas fa-users me-2"></i>Tim Teknis:</th>
                            <td>
                                @if ($ticket->tim_teknis)
                                    <span class="badge bg-success">{{ $ticket->tim_teknis }}</span>
                                @else
                                    <span class="badge bg-secondary">Belum ditentukan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-clipboard-list me-2"></i>Keterangan Tindakan:</th>
                            <td>{{ $ticket->keterangan_tindakan ?? 'Belum ada keterangan tindakan' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-file-alt me-2"></i>Dokumen Pendukung Tindakan:</th>
                            <td>
                                @if ($ticket->dok_pendukung_tindakan)
                                    <a href="{{ asset($ticket->dok_pendukung_tindakan) }}" target="_blank" class="text-primary"><i class="fas fa-file-alt me-2"></i>Lihat Dokumen Tindakan</a>
                                @else
                                    <span class="text-muted">Belum ada dokumen pendukung tindakan.</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-start gap-3 mt-4">
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <a href="{{ route('tickets.edit', $ticket->id_after_sales) }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit me-2"></i>Edit Tiket
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
