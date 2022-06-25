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
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h4 class="display-3 text-white animated slideInDown">UD. MAJU MAKMUR</h4>
                                <p class="fs-5 fw-medium text-white">Merupakan Toko yang bergerak di bidang
                                    penjualan beras</p>
                                <p class="fs-5 fw-medium text-white">yang berada di jalan Dadirejo 07/02 Penggaron Mojowarno.</p>
                                <a href="#produk" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Lihat Produk</a>
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
    <h4 class="text-center mt-4 mb-4" id="produk">PRODUK</h4>
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4 ">
            <form action="/">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search"
                        value="{{ request('search') }}">
                    <button class="btn btn-warning" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    @if ($beras->count() > 0)
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($beras as $b)
                    <div class="col-md-3 mt-3 mb-3">
                        <div class="card">
                            <img src="https://source.unsplash.com/1200x800?" class="card-img-top gambar" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $b->nama }}</h5>
                                <span class="badge bg-secondary">Rp. {{ $b->harga }}</span>
                                <span class="badge bg-secondary">{{ $b->berat }} Kg</span>
                                <div class="mt-3">
                                    <a href="#" class="btn-sm btn-primary text-decoration-none">Beli</a>
                                    <a href="/{{ $b->id }}" class="btn-sm btn-success text-decoration-none"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $b->id }}">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Modal -->
                @foreach ($beras as $be)
                    <div class="modal fade" id="exampleModal-{{ $be->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Beras</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="https://source.unsplash.com/1200x1200?"
                                                class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <h6>Nama : {{ $be->nama }}</h6>
                                            <h6>Harga : {{ $be->harga }}</h6>
                                            <h6>Berat : {{ $be->berat }}</h6>
                                            <h6>Kualitas : {{ $be->kualitas }}</h6>
                                            <h6>Persediaan : {{ $be->persediaan }}</h6>
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
            </div>
            <div class="justify-content-center">
                {{ $beras->links() }}
            </div>
            <!-- Back to Top -->
            <a href="#" class="btn btn-md btn-primary back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>
    @else
        <p class="text-center fs-4">Pencarian Beras Kosong.</p>
    @endif
@endsection
