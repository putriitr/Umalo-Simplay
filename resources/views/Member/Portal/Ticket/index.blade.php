@extends('layouts.Member.master') 
@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Tiket Layanan</h1>
</div>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="p-2 bg-light rounded" style="font-size: 1.25rem;">
            <h4 class="mb-0">Tiket Layanan Anda</h4>
            
        </div>

        <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="View">
            <i class="fas fa-plus-circle"></i> Buat Tiket Baru
        </a>
    </div>
    <div class="card shadow-sm border-0 rounded">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0"
                    style="border: 2px solid #8ab6d6; border-radius: 80px;">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Jenis Layanan</th>
                            <th>Keterangan Pengajuan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Tanggal Tindakan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $key => $ticket)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $ticket->jenis_layanan }}</td>
                                <td>{{ Str::limit($ticket->keterangan_layanan, 30) }}</td>
                                <td>{{ $ticket->tgl_pengajuan }}</td>
                                <td>
                                    <span class="badge 
                                                @if($ticket->status == 'open') bg-success 
                                                @elseif($ticket->status == 'progress') bg-warning 
                                                @else bg-secondary @endif">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($ticket->status == 'open')
                                        <span class="text-muted">Belum di Proses</span>
                                    @elseif($ticket->status == 'progress' && $ticket->tgl_mulai_tindakan)
                                        Mulai: {{ $ticket->tgl_mulai_tindakan }}
                                    @elseif($ticket->status == 'close' && $ticket->tgl_mulai_tindakan && $ticket->tgl_selesai_tindakan)
                                        Mulai: {{ $ticket->tgl_mulai_tindakan }}<br>
                                        Selesai: {{ $ticket->tgl_selesai_tindakan }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('tickets.show', $ticket->id_after_sales) }}"
                                        class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($ticket->status == 'open')
                                        <a href="{{ route('tickets.edit', $ticket->id_after_sales) }}"
                                            class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tickets.cancel', $ticket->id_after_sales) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                title="Batal">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada tiket layanan yang tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection