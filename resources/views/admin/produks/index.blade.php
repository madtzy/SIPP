@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold mt-2"><i class='bx bx-sm bxs-bowl-rice me-3'></i>DATA PRODUK</h4>
    <hr>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive">
        <a href="/admin/produks/create" class="btn btn-sm btn-primary mb-3"><i class="fa-solid fa-plus me-2"></i>Tambah
            Data</a>
        <table id="table" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produks as $produk)
                    <tr>
                        {{-- loops --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produk->nama }}</td>
                        <td>Rp. {{ $produk->harga }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td>
                            <a href="/admin/produks/{{ $produk->id }}" class="badge bg-success" data-bs-toggle="modal"
                                data-bs-target="#detail-{{ $produk->id }}"><i class="fa-solid fa-eye"></i></a>
                            <a href="/admin/produks/{{ $produk->id }}/edit" class="badge bg-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></span></a>
                            <a href="/admin/produks/{{ $produk->id }}" class="badge bg-danger" data-bs-toggle="modal"
                                data-bs-target="#hapus-{{ $produk->id }}"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- modal detail --}}
        @foreach ($produks as $produk)
            <div class="modal fade" id="detail-{{ $produk->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if ($produk->gambar)
                                        <div style="max-height:400px; overflow:hidden;">
                                            <img src="{{ asset('storage/' . $produk->gambar) }}" class="img-fluid">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <table>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{ $produk->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Harga</td>
                                            <td>:</td>
                                            <td>Rp. {{ $produk->harga }}</td>
                                        </tr>
                                        <tr>
                                            <td>Stok</td>
                                            <td>:</td>
                                            <td>{{ $produk->stok }} Karung</td>
                                        </tr>
                                        <tr>
                                            <td class="d-inline">Keterangan</td>
                                            <td>:</td>
                                            <td>{{ $produk->keterangan }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger border-0"
                                data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- modal hapus-->
        @foreach ($produks as $produk)
            <div class="modal fade" id="hapus-{{ $produk->id }}" tabindex="-1" aria-labelledby="hapus_produk"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="hapus_produk">HAPUS PRODUK</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah anda ingin menghapus data produk tersebut ?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="/admin/produks/{{ $produk->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-sm btn-primary border-0">
                                    Hapus
                                </button>
                            </form>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
