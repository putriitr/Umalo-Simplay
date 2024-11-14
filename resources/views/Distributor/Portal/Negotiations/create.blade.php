@extends('layouts.Member.master')
@section('content')
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