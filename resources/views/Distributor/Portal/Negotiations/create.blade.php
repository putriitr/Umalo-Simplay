@extends('layouts.Member.master')   
@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">{{ __('messages.create_negotiation') }}</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.breadcrumb_home') }}</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('distribution') }}">{{ __('messages.breadcrumb_distributor') }}</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('distribution.request-quotation') }}">{{ __('messages.request-quotation') }}</a></li>
        <li class="breadcrumb-item active text-primary">{{ __('messages.create_negotiation') }}</li>
    </ol>
</div>


<div class="container mt-5">
    <div class="card shadow-lg border-light rounded" style="max-width: 1200px; margin: auto;">
        <div class="card-body">
            <h3 class="text-left mb-4 text-secondary">{{ __('messages.negotiate_quotation') }}
                {{ $quotation->quotation_number }}
            </h3>

            <form action="{{ route('distributor.quotations.negotiations.store', $quotation->id) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="negotiated_price" class="form-label">{{ __('messages.negotiated_price') }}</label>
                    <input type="number" step="0.01" class="form-control form-control-lg bg-gray-light"
                        id="negotiated_price" name="negotiated_price"
                        placeholder="{{ __('messages.enter_negotiated_price') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="notes" class="form-label">{{ __('messages.notes') }}</label>
                    <textarea class="form-control form-control-lg bg-gray-light" id="notes" name="notes" rows="4"
                        placeholder="{{ __('messages.enter_notes') }}"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-4 py-2 shadow-sm">
                        <i class="bx bx-send"></i> {{ __('messages.submit_negotiation') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<style>
    .card {
        max-width: 1200px;
        margin: auto;
        background-color: #fff;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .form-group .form-label {
        font-weight: bold;
        font-size: 1.25rem;
        padding: 10px;
        display: block;
        margin-bottom: 0;
        background-color: #B3D7FF;
        color: white;
    }

    .bg-blue-light {
        background-color: #B3D7FF;
    }

    .bg-gray-light {
        background-color: #F1F1F1;
        border: 1px solid #D1D1D1;
    }

    .form-control,
    .form-control-lg {
        background-color: #F1F1F1 !important;
        color: #000 !important;
        border: 1px solid #D1D1D1 !important;
        box-shadow: none;
        padding: 15px;
        font-size: 1rem;
        border-radius: 0 !important;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus,
    .form-control-lg:focus {
        background-color: #D9E9FF !important;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3) !important;
        outline: none;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 12px 30px;
        font-size: 1.1rem;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary i {
        margin-right: 8px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-lg {
        padding: 12px 30px;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .card {
            padding: 20px;
        }

        .btn-lg {
            width: 100%;
        }

        .form-control,
        .form-control-lg {
            font-size: 0.9rem;
            padding: 12px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }
    }
</style>