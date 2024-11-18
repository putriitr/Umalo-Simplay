@extends('layouts.Member.master')  
@section('content')


<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h2 class="text-center mb-4">Daftar Negosiasi</h2>
    </div>
</div>
<!-- Header End -->

<div class="container mt-5">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-left mb-4">List Daftar Negosiasi</h3>
        </div>

        <div class="card shadow border-0 rounded custom-card">
            <div class="card-body p-4">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th style="width: 10%;">ID</th>
                            <th style="width: 20%;">Quotation Number</th>
                            <th style="width: 20%;">Negotiated Price</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 20%;">Notes</th>
                            <th style="width: 15%;">Admin Notes</th>
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
                                <td class="text-center">{{ $negotiation->admin_notes ?? 'N/A' }}</td>
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
    .custom-card {
        max-width: 1400px; /* Adjusted max width for better responsiveness */
        margin: auto;
        background-color: #f8f9fa;
        border-radius: 20px; /* Reduced border-radius for cleaner look */
    }

    .custom-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 1.2rem;  /* Slightly reduced font size for better readability */
    }

    .custom-table th {
        background-color: #e0e0e0;
        color: #333;
        font-weight: bold;
        text-align: center;
        padding: 20px;  /* Reduced padding for cleaner table */
        border: 1px solid #bbb;  /* Reduced border thickness */
    }

    .custom-table td {
        background-color: #ffffff;
        color: #555;
        padding: 20px;  /* Reduced padding for a more compact layout */
        text-align: center;
        border: 1px solid #ddd;  /* Reduced border thickness */
    }

    .custom-table tbody tr:hover {
        background-color: #f3f3f3;
    }

    /* Badge color styles */
    .badge {
        padding: 10px 20px;  /* Adjusted padding */
        border-radius: 10px;  /* Slightly reduced radius */
        font-size: 1.2rem;  /* Slightly reduced font size for badges */
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
</style>
