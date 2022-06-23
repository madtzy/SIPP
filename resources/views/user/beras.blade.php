@extends('user.layouts.main')
@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/img/1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/img/2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/img/3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <h4 class="text-center mt-4 mb-4">PRODUK</h4>
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
                                        <img src="https://source.unsplash.com/1200x1200?" class="img-fluid rounded-start"
                                            alt="...">
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
    </div>
    @else
    <p class="text-center fs-4">Pencarian Beras Kosong.</p>
    @endif
@endsection
