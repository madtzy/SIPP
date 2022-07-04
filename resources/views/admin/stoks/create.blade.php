@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold">FORM TAMBAH STOK</h4>
    <hr>
    <form action="/admin/buyers" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="hidden" name="produk_id" class="form-control" value="{{ $produk->name }}">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required>
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
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
                class="form-control @error('nomor_telp') is-invalid @enderror" value="{{ old('nomor_telp') }}" required>
            @error('nomor_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                value="{{ old('tanggal') }}" required>
            @error('tanggal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="jumlah">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
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
                class="form-control @error('total_bayar') is-invalid @enderror" value="{{ old('total_bayar') }}"
                required>
            @error('total_bayar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/admin/produks" class="btn btn-danger">Kembali</a>
    </form>
    @endsection
