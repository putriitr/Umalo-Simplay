@extends('layouts.Member.master')
@section('content')

<!-- Header -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Create Purchase Order</li>
        </ol>
    </div>
</div>

<!-- Form Section -->
<div class="container mt-5">
    <div class="card shadow-lg border-light rounded" style="max-width: 100%; margin: auto;">
        <div class="card-body">
            <h2 class="text-secondary mb-4">Create Purchase Order for Quotation {{ $quotation->quotation_number }}</h2>
            <form action="{{ route('quotations.store_po', $quotation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="po_number" class="form-label">PO Number</label>
                    <input type="text" class="form-control" id="po_number" name="po_number" required placeholder="Enter PO Number">
                </div>

                <div class="form-group mb-3">
                    <label for="po_date" class="form-label">PO Date</label>
                    <input type="date" class="form-control" id="po_date" name="po_date" required>
                </div>

                <div class="form-group mb-3">
                    <label for="file_path" class="form-label">Upload PO File (optional)</label>
                    <input type="file" class="form-control" id="file_path" name="file_path" accept=".pdf,.doc,.docx">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4 py-3">
                        <i class="bx bx-file"></i> Create PO
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<style>
    .card {
        max-width: 100%;
        margin: auto;
        background-color: #fff;
        padding: 30px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: bold;
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 10px;
    }

    .form-control {
        font-size: 1rem;
        padding: 12px;
        background-color: #f8f9fa;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease;
        width: 100%;
        border-radius: 0;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 12px 30px;
        font-size: 1.2rem;
        border-radius: 25px;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-primary i {
        margin-right: 8px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    @media (max-width: 768px) {
        .card {
            padding: 20px;
        }

        .form-control {
            font-size: 0.9rem;
            padding: 10px;
        }

        .btn-primary {
            font-size: 1.1rem;
            padding: 10px 25px;
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .btn-primary {
            font-size: 1rem;
            padding: 8px 20px;
        }

        .form-control {
            font-size: 0.9rem;
            padding: 8px;
        }
    }
</style>
