@extends('layouts.Member.master')
@section('content')
  <!-- Header Start -->
  <div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Daftar Negosiasi
        </h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Daftar Negosiasi</li>
        </ol>
    </div>
</div>
<!-- Header End --><br><br>
<div class="container mt-5">
    <h2>Daftar Negosiasi</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Quotation Number</th>
                <th>Negotiated Price</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Admin Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($negotiations as $negotiation)
                <tr>
                    <td>{{ $negotiation->id }}</td>
                    <td>{{ $negotiation->quotation->quotation_number }}</td>
                    <td>{{ number_format($negotiation->negotiated_price, 2) }}</td>
                    <td>{{ ucfirst($negotiation->status) }}</td>
                    <td>{{ $negotiation->notes }}</td>
                    <td>{{ $negotiation->admin_notes ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection