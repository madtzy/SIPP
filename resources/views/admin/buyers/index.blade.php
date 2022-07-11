@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold mt-2"><i class='bx bx-sm bxs-cart me-3'></i>DATA PEMESAN</h4>
    <hr>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive">
        <table id="table" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buyers as $buyer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $buyer->nama }}</td>
                        <td>{{ $buyer->alamat }}</td>
                        <td>{{ $buyer->nomor_telp }}</td>
                        <td>{{ $buyer->tanggal }}</td>
                        <td>{{ $buyer->status }}</td>
                        <td>
                            <a href="/admin/buyers/{{ $buyer->id }}" class="badge bg-success"><i
                                    class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
