@extends('layouts.Member.master')

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">{{ __('messages.list_negotiation') }}</h1>

    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.distributor_portal') }}</a></li>
        <li class="breadcrumb-item active text-primary">{{ __('messages.list_negotiation') }}</li>
    </ol>
</div>

<div class="container mt-5">
    <div class="container py-5">
        <div class="card shadow-lg border-light rounded">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-left mb-4 text-secondary">{{ __('messages.list_negotiation') }}</h3>
                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 10%;">{{ __('messages.id') }}</th>
                            <th style="width: 20%;">{{ __('messages.quotation_number') }}</th>
                            <th style="width: 20%;">{{ __('messages.negotiated_price') }}</th>
                            <th style="width: 15%;">{{ __('messages.status') }}</th>
                            <th style="width: 20%;">{{ __('messages.notes') }}</th>
                            <th style="width: 15%;">{{ __('messages.admin_notes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($negotiations as $negotiation)
                            <tr>
                                <td class="text-center">{{ $negotiation->id }}</td>
                                <td class="text-center">{{ $negotiation->quotation->quotation_number }}</td>
                                <td class="text-center">{{ number_format($negotiation->negotiated_price, 2) }}</td>
                                <td class="text-center">
                                    <span class="badge 
                                        @if($negotiation->status == 'approved') bg-success 
                                        @elseif($negotiation->status == 'pending') bg-warning 
                                        @else bg-danger 
                                        @endif">
                                        {{ ucfirst($negotiation->status) }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $negotiation->notes }}</td>
                                <td class="text-center">{{ $negotiation->admin_notes ?? __('messages.not_available') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
    .card {
        max-width: 1200px;
        margin: auto;
        background-color: #f8f9fa;
        border-radius: 20px;
    }

    .table {
        width: 100%;
        font-size: 1rem;
        text-align: center;
        border-collapse: collapse;
    }

    .table th {
        background-color: #e0e0e0;
        color: #333;
        font-weight: bold;
        padding: 15px;
        border: 1px solid #bbb;
    }

    .table td {
        background-color: #ffffff;
        color: #555;
        padding: 15px;
        border: 1px solid #ddd;
    }

    .table tbody tr:hover {
        background-color: #f3f3f3;
    }

    /* Badge color styles */
    .badge {
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
    }

    .bg-success {
        background-color: #28a745 !important;
        color: white;
    }

    .bg-warning {
        background-color: #ffc107 !important;
        color: white;
    }

    .bg-danger {
        background-color: #dc3545 !important;
        color: white;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .table th, .table td {
            padding: 10px;
        }
    }

    @media (max-width: 576px) {
        .table th, .table td {
            padding: 8px;
        }
    }
</style>
