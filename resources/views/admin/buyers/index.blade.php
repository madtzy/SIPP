@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold mt-2"><i class='bx bx-sm bxs-bowl-rice me-3'></i>DATA PEMESAN</h4>
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
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buyers as $buyer)
                    <tr>
                        {{-- loops --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $buyer->nama }}</td>
                        <td>{{ $buyer->alamat }}</td>
                        <td>{{ $buyer->nomor_telp }}</td>
                        <td>{{ $buyer->tanggal}}</td>
                        <td>
                            <a href="/admin/buyers/{{ $buyer->id }}" class="badge bg-success"
                                        data-bs-toggle="modal" data-bs-target="#detail-{{ $buyer->id }}"><i class="fa-solid fa-eye"></i></a>
                            <form action="/admin/buyers/{{ $buyer->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure ?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- modal detail --}}
        @foreach ($buyers as $buyer)
            <div class="modal fade" id="detail-{{ $buyer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Pemesan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="https://source.unsplash.com/1200x1000?" class="img-fluid rounded-start"
                                        alt="...">
                                </div>
                                <div class="col-md-8">
                                    <table>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{ $buyer->produk->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah</td>
                                            <td>:</td>
                                            <td>{{ $buyer->harga }} Karung</td>
                                        </tr>
                                        <tr>
                                            <td>Total Bayar</td>
                                            <td>:</td>
                                            <td>Rp. {{ $buyer->stok }}</td>
                                        </tr>
                                    </table>
                                    {{-- <h6>Nama : {{ $produk->nama }}</h6>
                                            <h6>Keterangan : {{ $produk->keterangan }}</h6>
                                            <h6>Harga : Rp. {{ $produk->harga }}</h6>
                                            <h6>Stok : {{ $produk->stok }}</h6> --}}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="badge bg-danger border-0" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
