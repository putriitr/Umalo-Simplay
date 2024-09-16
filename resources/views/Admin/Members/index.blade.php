@extends('layouts.admin.master')

@section('content')
<div class="container mt-5">
    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1 class="card-title">Daftar Member</h1>
                    <a href="{{ route('members.create') }}" class="btn btn-primary">Tambah Member</a>
                </div>



                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Nomor Telepon</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->nama_perusahaan }}</td>
                                        <td>{{ $member->no_telp }}</td>
                                        <td>{{ $member->alamat }}</td>
                                        <td>
                                            <a href="{{ route('members.show', $member->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this member?');">Delete</button>
                                            </form>
                                            <a href="{{ route('members.add-products', $member->id) }}" class="btn btn-secondary btn-sm">Tambah Produk</a>
                                            <a href="{{ route('members.edit-products', $member->id) }}" class="btn btn-warning btn-sm">Edit Produk</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $members->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
