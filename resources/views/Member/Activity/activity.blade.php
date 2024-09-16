@extends('layouts.member.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Aktivitas Perusahaan</h3>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item active text-primary">Aktivitas</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Activity Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <!-- Navigation Section -->
            <div class="row mb-4">
                <!-- Showing X-Y of Z -->
                <div class="col-md-4 d-flex align-items-center">
                    <p class="mb-0">Menampilkan {{ $activities->firstItem() }} - {{ $activities->lastItem() }} dari
                        {{ $activities->total() }}</p>
                </div>
                <!-- Show per Page and Sort By -->
                <div class="col-md-8 d-flex justify-content-end align-items-center">
                    <div class="d-flex align-items-center">
                        <label for="sort-by" class="mb-0 me-4" style="display: inline-block; white-space: nowrap;">
                            Urut berdasarkan :
                        </label>
                        <select id="sort-by" class="form-select form-select-sm">
                            <option value="newest">Terbaru</option>
                            <option value="latest">Terlama</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Activity Content -->
            <div class="row g-4 justify-content-center">
                @foreach ($activities as $item)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="blog-item rounded"
                            style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 15px;">
                            <div class="blog-img">
                                <img src="{{ asset('images/' . $item->image) }}" class="img-fluid w-100" alt="Image"
                                    style="border-radius: 15px; width: 100%; height: 250px; object-fit: cover;">
                            </div>
                            <div class="blog-content p-4" style="flex-grow: 1;">
                                <div class="d-flex justify-content-between mb-4">
                                    <p class="mb-0 text-muted" style="font-size: 0.875rem;"><i
                                            class="fa fa-calendar-alt text-primary"></i> {{ $item->date->format('d M Y') }}
                                    </p>
                                </div>
                                <a href="" class="h4"
                                    style="font-weight: bold; color: #343a40; text-decoration: none;">{{ $item->title }}</a>
                                <p class="my-4"
                                    style="
                                    font-size: 0.875rem;
                                    color: #6c757d;
                                    margin: 0;
                                    line-height: 1.5;
                                    overflow: hidden;
                                    white-space: normal;
                                    word-wrap: break-word;
                                ">
    {{ Str::limit($item->description, 40) }}
</p>

                                <a href="{{ route('activity.show', $item->id) }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-1"
                                    style="background-color: #007BFF; border: none;">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12">
                    {{ $activities->links() }} <!-- Menampilkan pagination -->
                </div>
            </div>
        </div>
    </div>
    <!-- Activity End -->
@endsection
