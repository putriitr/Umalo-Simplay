@extends('layouts.Member.master')

@section('content')

<!-- Main Content -->
<div class="container my-5">

    <h1 class="text-center mb-4">{{ __('messages.quotation_request_detail') }}</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
        <li class="breadcrumb-item active text-primary">{{ __('messages.quotation_request_detail') }}</li>
    </ol>
</div>

<div class="container mt-5">
    <!-- Display List of Products in Quotation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg border-light rounded">
                <div class="card-body">
                    <!-- General Quotation Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card shadow-sm border-light rounded">
                                <div class="card-body">
                                    <h5 class="text-primary mb-3">{{ __('messages.quotation_info') }}</h5>
                                    <p><strong>Number:</strong> {{ $quotation->quotation_number }}</p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <p class="mb-0" style="font-size: 1rem;"><strong>{{ __('messages.status') }}:</strong>
                                            <span
                                                class="badge bg-{{ $quotation->status == 'approved' ? 'success' : ($quotation->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($quotation->status) }}
                                            </span>
                                        </p>
                                    </div>
                                    <p class="mb-0" style="font-size: 1rem;"><strong>{{ __('messages.request_date') }}:</strong>
                                        {{ $quotation->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-4">
                        <div class="col-12">

                            <div class="card shadow-sm border-light rounded">
                                <div class="card-body">
                                    <h5 class="text-primary mb-3">{{ __('messages.products_in_quotation') }}:</h5>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center">{{ __('messages.no') }}</th>
                                                    <th>{{ __('messages.product_name') }}</th>
                                                    <th>{{ __('messages.brand') }}</th>
                                                    <th>{{ __('messages.quantity') }}</th>
                                                    <th>{{ __('messages.unit_price') }}</th>
                                                    <th>{{ __('messages.total_price') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($quotation->quotationProducts as $index => $product)
                                                    <tr>
                                                        <td class="text-primary text-center">{{ $index + 1 }}</td>
                                                        <td>{{ $product->equipment_name ?? __('messages.product_unavailable') }}</td>
                                                        <td>{{ $product->merk_type ?? __('messages.unavailable') }}</td>
                                                        <td class="text-center">{{ $product->quantity }}</td>
                                                        <td class="text-center">{{ number_format($product->unit_price, 2) }}</td>
                                                        <td class="text-center">{{ number_format($product->total_price, 2) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted">{{ __('messages.no_products_in_quotation') }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Display PDF file if available -->
                    <div class="row mb-4">
                        <div class="col-12">

                            <div class="card shadow-sm border-light rounded">
                                <div class="card-body">
                                    <h5 class="text-primary mb-3">{{ __('messages.pdf_document') }}:</h5>
                                    @if($quotation->pdf_path)
                                        <div class="d-flex gap-3">
                                            <a href="{{ asset($quotation->pdf_path) }}" target="_blank"
                                                class="btn btn-primary rounded-3">
                                                <i class="fas fa-file-alt me-2"></i>{{ __('messages.view_pdf') }}
                                            </a>
                                            <a href="{{ asset($quotation->pdf_path) }}" download
                                                class="btn btn-secondary rounded-3">
                                                <i class="fas fa-download me-2"></i>{{ __('messages.download_pdf') }}
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-muted">{{ __('messages.no_file_available') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

<style>
    /* Custom Styling */
    .badge {
        font-weight: bold;
        padding: 0.5rem;
    }

    /* Table Styling */
    .table {
        font-size: 1rem;
        border-radius: 10px;
        border: 1px solid #ddd;
        /* Light gray border */
        background-color: #fff;
        color: #000;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    .table-light {
        background-color: #f8f9fa;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .text-primary {
        color: #17a2b8 !important;
    }

    /* Card Styling */
    .card {
        border-radius: 10px;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Button Styling */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-size: 1rem;
        padding: 10px 20px;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        font-size: 1rem;
        padding: 10px 20px;
    }

    .rounded-3 {
        border-radius: 20px;
    }

    /* Flex Layout for Documents */
    .d-flex {
        display: flex;
        align-items: center;
    }

    .gap-3 {
        gap: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }

        .table th,
        .table td {
            font-size: 0.9rem;
        }
    }
</style>
