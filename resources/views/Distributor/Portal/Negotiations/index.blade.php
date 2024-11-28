@extends('layouts.Member.master')
@section('content')
<!-- Header Start -->
<div class="container mt-5"></div>
<h1 class="text-center mb-4">Daftar Negosiasi</h1>
<ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
    <li class="breadcrumb-item active text-primary">Daftar Negosiasi</li>
</ol>
<!-- Header End -->

<div class="container mt-5">
    <div class="p-4 shadow-sm rounded bg-white">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center" style="vertical-align: middle;">ID</th>
                            <th scope="col" class="text-center" style="vertical-align: middle;">Quotation Number</th>
                            <th scope="col" class="text-center" style="vertical-align: middle;">Status</th>
                            <th scope="col" class="text-center" style="vertical-align: middle;">Notes</th>
                            <th scope="col" class="text-center" style="vertical-align: middle;">Admin Notes</th>
                            <th scope="col" class="text-center" style="vertical-align: middle;">Actions</th>

                        </tr>
                    </thead>
                    <tbody style="background-color: #f9f9f9;">
                        @foreach($negotiations as $negotiation)
                            <tr style="vertical-align: middle;">
                                <td class="text-center">{{ $negotiation->id }}</td>
                                <td class="text-center">{{ $negotiation->quotation->quotation_number }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $negotiation->status == 'accepted' ? 'bg-success' : ($negotiation->status == 'rejected' ? 'bg-danger' : 'bg-warning') }} text-uppercase">
                                        {{ ucfirst($negotiation->status) }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $negotiation->notes }}</td>
                                <td class="text-center">{{ $negotiation->admin_notes ?? 'N/A' }}</td>
                                <td class="text-center">
                                    @if ($negotiation->status === 'accepted' && !$negotiation->quotation->purchaseOrder)
                                        <!-- Tombol Create PO hanya muncul jika PO belum dibuat -->
                                        <a href="{{ route('quotations.create_po', $negotiation->quotation->id) }}"
                                            class="btn btn-success btn-sm rounded-pill">
                                            <i class="fas fa-file-invoice-dollar"></i> Create PO
                                        </a>
                                    @elseif ($negotiation->status === 'pending' || $negotiation->status === 'in_progress')
                                        <!-- Tombol Nego -->
                                        <a href="{{ route('distributor.quotations.negotiations.create', $negotiation->quotation->id) }}"
                                            class="btn btn-warning btn-sm rounded-pill">
                                            <i class="fas fa-handshake"></i> Nego
                                        </a>
                                    @endif

                                    <!-- Tombol Download PDF -->
                                    @if ($negotiation->quotation->pdf_path)
                                        
                                        <a href="{{ asset($negotiation->quotation->pdf_path) }}" download
                                            class="btn btn-outline-secondary ms-2 shadow-sm">
                                            <i class="fas fa-download me-2"></i> Download PDF
                                        </a>
                                    @else
                                        <span class="text-muted d-block mt-2">No PDF Available</span>
                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Tombol Kembali -->
                <div class="text-end mt-4">

                    <a href="{{ route('distribution.request-quotation') }}"
                        class="btn btn-outline-secondary ms-2 shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection