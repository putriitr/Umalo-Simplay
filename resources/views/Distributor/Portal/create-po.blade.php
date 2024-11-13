@extends('layouts.Member.master')
@section('content')
  <!-- Header Start -->
  <div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Pembuatan Purchase Order (PO)</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('distribution') }}">Distributor Portal</a></li>
            <li class="breadcrumb-item active text-primary">Pembuatan Purchase Order (PO)</li>
        </ol>
    </div>
</div>
<!-- Header End --><br><br>
<div class="container">
    <h2>Pembuatan Purchase Order (PO)</h2>
    <p>Di sini Anda dapat membuat dan mengirim Purchase Order (PO) berdasarkan quotation yang diterima.</p>
    <!-- Tambahkan formulir untuk pembuatan PO di sini -->
</div>
@endsection