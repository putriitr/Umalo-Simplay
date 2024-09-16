@extends('layouts.admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title"><h1>Produk</h1></div>
                    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk Baru</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Merk</th>
                                        <th>Via</th>
                                        <th>Kategori</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produks as $produk)
                                        <tr>
                                            <td>{{ $produk->id }}</td>
                                            <td class="text-truncate" style="max-width: 150px;">{{ $produk->nama }}</td>
                                            <td class="text-truncate" style="max-width: 100px;">{{ $produk->merk }}</td>
                                            <td>{{ ucfirst($produk->via) }}</td>
                                            <td>{{ $produk->kategori->nama }}</td>
                                            <td>
                                                @foreach ($produk->images as $image)
                                                    <img src="{{ asset($image->gambar) }}" class="img-fluid w-100" alt="{{ $produk->nama }}" style="max-width: 250px; height: auto;">
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.produk.show', $produk->id) }}" class="btn btn-info btn-sm">Tampilkan</a>
                                                <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
