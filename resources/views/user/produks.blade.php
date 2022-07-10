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
    <h5 class="text-center mt-2 mb-4" id="produk">PRODUK</h5>
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
                    <div class="col-sm-6 col-lg-4 col-xl-3 mt-3 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top"
                                style="height: 230px">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $produk->nama }}</h5>
                                <span class="badge badge-sm bg-success">Rp. {{ $produk->harga }}</span>
                                <span class="badge badge-sm bg-secondary">{{ $produk->stok }} Karung</span>
                                <div class="mt-3">
                                    <a href="/beli/{{ $produk->id }}"
                                        class="btn-sm btn-primary text-decoration-none me-2">Beli</a>
                                    <a href="/beli/{{ $produk->id }}" class="btn-sm btn-warning text-decoration-none"
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
                                            <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top">
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
                                    <button type="button" class="btn btn-sm btn-danger"
                                        data-bs-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="justify-content-center">
                {{ $produks->links() }}
            </div>
            <!-- Back to Top -->
            <a href="#" class="btn btn-md btn-primary back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>
    @else
        <p class="text-center fs-4">Produk Kosong.</p>
    @endif
@endsection

@section('footer')
    <div class="container-fluid bg-dark">
        <div class="text-center text-white p-3 mt-4">
            <p class="footer pt-3">Copyright &copy; 2022 SIPP | UD MAJU MAKMUR</p>
        </div>
    </div>
@endsection
