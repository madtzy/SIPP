@extends('user.layouts.main')
@section('content')
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    <!-- Carousel Start -->
    <div class="p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative" data-dot="<img src='img/1.jpg'>">
                <img class="img-fluid img-corousel" src="/img/1.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-10 col-lg-8 align-content-center">
                                <p class="text-white judul">UD. MAJU MAKMUR</p>
                                <p class="text-white deskripsi">Merupakan Toko yang bergerak di bidang penjualan beras yang
                                    berada di jalan Dadirejo 07/02 Penggaron Mojowarno.</p>
                                <a href="#produk" class="btn btn-primary rounded-pill border-0 py-2 px-5 btn-list">List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative" data-dot="<img src='img/2.jpg'>">
                <img class="img-fluid img-corousel" src="/img/2.jpg" alt="">
            </div>
            <div class="owl-carousel-item position-relative" data-dot="<img src='img/3.jpg'>">
                <img class="img-fluid img-corousel" src="/img/3.jpg" alt="">
            </div>
        </div>
    </div>
    <h5 class="text-center mt-4 mb-4" id="produk">PRODUK</h5>
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4 ">
            <form action="/">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Masukkan Produk"
                        value="{{ request('search') }}">
                    <button class="btn btn-warning" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    @if ($produks->count() > 0)
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($produks as $produk)
                    <div class="col-md-6 col-lg-4 col-xl-3 mt-3 mb-3">
                        <div class="card">
                            <img src="https://source.unsplash.com/1200x800?" class="card-img-top gambar" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $produk->nama }}</h5>
                                <span class="badge badge-sm bg-success">Rp. {{ $produk->harga }}</span>
                                <span class="badge badge-sm bg-secondary">{{ $produk->stok }} Karung</span>
                                <div class="mt-3">
                                    <a href="/beli" class="btn-sm btn-primary text-decoration-none">Beli</a>
                                    <a href="/{{ $produk->id }}" class="btn-sm btn-warning text-decoration-none"
                                        data-bs-toggle="modal" data-bs-target="#detail-{{ $produk->id }}">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- modal detail-->
                @foreach ($produks as $produk)
                    <div class="modal fade" id="detail-{{ $produk->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="https://source.unsplash.com/1200x1000?"
                                                class="img-fluid rounded-start" alt="...">
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
                                                    <td>{{ $produk->stok }} Kg.</td>
                                                </tr>
                                                <tr>
                                                    <td class="d-inline">Keterangan</td>
                                                    <td>:</td>
                                                    <td>{{ $produk->keterangan }}</td>
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
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- modal beli --}}
                {{-- @foreach ($produks as $produk)
                <div class="modal fade" id="beli-{{ $produk->id }}" tabindex="-1" aria-labelledby="beli_beras" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">FORM PEMBELIAN BERAS</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/admin/buyers" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="produk_id" class="form-control" value="{{ $produk->name }}">
                                        <label for="nama">Nama</label>
                                        <input type="text" id="nama" name="nama"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" id="alamat" name="alamat"
                                            class="form-control @error('alamat') is-invalid @enderror"
                                            value="{{ old('alamat') }}" required>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="nomor_telp">No Telp</label>
                                        <input type="number" id="nomor_telp" name="nomor_telp"
                                            class="form-control @error('nomor_telp') is-invalid @enderror"
                                            value="{{ old('nomor_telp') }}" required>
                                        @error('nomor_telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" id="tanggal" name="tanggal"
                                            class="form-control @error('tanggal') is-invalid @enderror"
                                            value="{{ old('tanggal') }}" required>
                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" id="jumlah" name="jumlah"
                                            class="form-control @error('jumlah') is-invalid @enderror"
                                            value="{{ old('jumlah') }}" required>
                                        @error('jumlah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="total_bayar">Total Bayar</label>
                                        <input type="number" id="total_bayar" name="total_bayar"
                                            class="form-control @error('total_bayar') is-invalid @enderror"
                                            value="{{ old('total_bayar') }}" required>
                                        @error('total_bayar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Checkout</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach --}}
            </div>
            <div class="justify-content-center">
                {{ $produks->links() }}
            </div>
            <!-- Back to Top -->
            <a href="#" class="btn btn-md btn-primary back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>
    @else
        <p class="text-center fs-4">Pencarian Produk Kosong.</p>
    @endif
@endsection
