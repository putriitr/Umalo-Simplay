@extends('layouts.Member.master')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">{{ __('messages.choose_product_quotation') }}</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.breadcrumb_home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('distribution') }}">{{ __('messages.breadcrumb_distributor') }}</a></li>
        <li class="breadcrumb-item active text-primary">{{ __('messages.breadcrumb_choose_quotation') }}</li>
    </ol>
</div>

<div class="container mt-5">
    <div class="d-flex justify-content-center justify-content-md-between mb-4 flex-wrap gap-3">
        
        <a href="{{ route('quotations.cart') }}" class="btn btn-info btn-lg shadow-sm">
            <i class="bx bx-cart"></i> {{ __('messages.cart_view') }}
        </a>
    </div>

    <!-- Tabel Daftar Permintaan Quotation -->
    <div class="card shadow-lg border-light rounded">
        <div class="card-body">
            <h3 class="mb-4 text-secondary">{{ __('messages.quotation_list') }}</h3>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>{{ __('messages.nomor_pengajuan') }}</th>
                        <th>{{ __('messages.nama_produk') }}</th>
                        <th>{{ __('messages.quantity') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotations as $key => $quotation)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $quotation->nomor_pengajuan ?? __('messages.no_submission_number') }}</td>
                            <td>
                                @foreach ($quotation->quotationProducts as $product)
                                    <span class="d-block">{{ $product->equipment_name ?? __('messages.no_product_available') }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($quotation->quotationProducts as $product)
                                    <span class="d-block">{{ $product->quantity ?? __('messages.no_quantity') }}</span>
                                @endforeach
                            </td>
                            <td>
                                <span class="badge 
                                    @if ($quotation->status === 'cancelled') bg-danger
                                    @elseif ($quotation->status === 'quotation') bg-primary
                                    @else bg-warning @endif text-white">
                                    {{ ucfirst(__('messages.' . $quotation->status)) }}
                                </span>
                            </td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('quotations.show', $quotation->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bx bx-show"></i> {{ __('messages.view') }}
                                </a>
                                
                                @if ($quotation->status === 'pending')
                                    <form action="{{ route('quotations.cancel', $quotation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('{{ __('messages.cancel_confirmation') }}');">
                                            <i class="bx bx-x-circle"></i> {{ __('messages.cancel') }}
                                        </button>
                                    </form>
                                @elseif($quotation->status === 'quotation')
                                    @if (!$quotation->purchaseOrder)
                                        <a href="{{ route('distributor.quotations.negotiations.create', $quotation->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bx bx-dollar-circle"></i> {{ __('messages.negotiate') }}
                                        </a>
                                        <a href="{{ route('quotations.create_po', $quotation->id) }}" class="btn btn-success btn-sm">
                                            <i class="bx bx-file"></i> {{ __('messages.create_po') }}
                                        </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">{{ __('messages.no_quotation_request') }}</td>
                        </tr>
                    @endforelse
                </tbody>
                
            </table>
            <a href="{{ url('/en/products') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="bx bx-file"></i> {{ __('messages.create_quotation') }}
            </a>
        </div>
    </div>
</div>

@endsection
