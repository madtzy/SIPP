@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold mt-2"><i class='bx bx-sm bxs-customize me-3'></i>DATA STOK</h4>
    <hr>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive">
        <a href="/admin/stoks/create" class="btn btn-sm btn-primary mb-3"><i class="fa-solid fa-plus me-2"></i>Tambah
            Data</a>
        <table id="table" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">tanggal</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Kualitas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stoks as $stok)
                    <tr>
                        {{-- loops --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $stok->produk->nama }}</td>
                        <td>{{ $stok->tanggal }}</td>
                        <td>{{ $stok->stok }}</td>
                        <td>{{ $stok->kualitas }}</td>
                        <td>
                            <a href="/admin/stoks/{{ $stok->id }}/edit" class="badge bg-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
