@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold mt-2"><i class='bx bx-sm bxs-dashboard me-3'></i>Dashboard </h4>
    <div class="container mb-5">
        @if(Auth::user()->is_admin==1)
        <div class="row">
            <div class="col">
                <div class="card mb-1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Penjualan</h5>
                        <h1>{{ $penjualan }}</h1>
                        <p class="card-text">Karung</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Stok</h5>
                        <h1>{{ $stok }}</h1>
                        <p class="card-text">Karung</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Penghasilan</h5>
                        <h1>{{ $penghasilan }}</h1>
                        <p class="card-text">Rupiah</p>
                    </div>
                </div>
            </div>

        </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card mb-1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Penjualan Diproses</h5>
                        <h1>{{ $diproses }}</h1>
                        <p class="card-text">Pesanan</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Penjualan Diterima</h5>
                        <h1>{{ $diterima }}</h1>
                        <p class="card-text">Pesanan</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Penjualan Ditolak</h5>
                        <h1>{{ $ditolak }}</h1>
                        <p class="card-text">Pesanan</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
