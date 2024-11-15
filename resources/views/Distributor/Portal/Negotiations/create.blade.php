@extends('layouts.Member.master')
@section('content')

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Create Negotiate</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Create Negotiate</li>
        </ol>
    </div>
</div>
<!-- Header End --><br><br>
 
<div class="container mt-5">
    <h2>Negotiate Quotation #{{ $quotation->quotation_number }}</h2>
    
    <form action="{{ route('distributor.quotations.negotiations.store', $quotation->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="negotiated_price">Negotiated Price</label>
            <input type="number" step="0.01" class="form-control" id="negotiated_price" name="negotiated_price" required>
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit Negotiation</button>
    </form>
</div>
@endsection