@extends('layouts.Member.master')  
@section('content')

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h2 class="text-center mb-4">Buat Daftar Negosiasi</h2>
    </div>
</div>

<!-- Header End -->

<div class="container mt-5">
    <div class="card custom-card shadow-lg p-4">
        <h3 class="text-center mb-4 text-primary">Negotiate Quotation {{ $quotation->quotation_number }}</h3>
        
        <form action="{{ route('distributor.quotations.negotiations.store', $quotation->id) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="negotiated_price" class="form-label">Negotiated Price</label>
                <input type="number" step="0.01" class="form-control form-control-lg" id="negotiated_price" name="negotiated_price" required>
            </div>

            <div class="form-group mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control form-control-lg" id="notes" name="notes" rows="4"></textarea>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-primary btn-lg px-2 py-2">Submit Negotiation</button>
            </div>
        </form>
    </div>
</div>

@endsection

<style>
    /* Custom Card */
    .custom-card {
        max-width: 1200px;
        margin: auto;
        background-color: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Form Elements */
    .form-group .form-label {
        font-weight: bold;
        color: #555;
    }

    .form-control, .form-control-lg {
        border-radius: 10px;
        font-size: 1.1rem;
        padding: 15px;
        border: 2px solid #ccc;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }

    /* Button Styles */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 25px;
        padding: 12px 30px;
        font-size: 1.2rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-lg {
        padding: 15px 30px;
        font-size: 1.1rem;
    }

    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .custom-card {
            padding: 20px;
        }

        .btn-lg {
            width: 100%;
        }
    }
</style>
