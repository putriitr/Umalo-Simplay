@extends('layouts.Member.master')
@section('content')
<div class="container">
    <h2>Detail Permintaan Quotation</h2>
    <p><strong>Nama Produk:</strong> {{ $quotation->produk->nama ?? 'Produk tidak tersedia' }}</p>
    <p><strong>Quantity:</strong> {{ $quotation->quantity }}</p>
    <p><strong>Status:</strong> {{ ucfirst($quotation->status) }}</p>
    <p><strong>Tanggal Permintaan:</strong> {{ $quotation->created_at->format('d M Y') }}</p>
    
    <a href="{{ route('distribution.request-quotation') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection