@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold">FORM EDIT PRODUK</h4>
    <hr>
    <form action="/admin/produks/{{ $produk->id }}" method="post" class="mb-3 border-1" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-2">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                value="{{ old('nama', $produk->nama) }}" required>
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
                value="{{ old('harga', $produk->harga) }}" required>
            @error('harga')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok"
                value="{{ old('stok', $produk->stok) }}" required>
            @error('stok')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input class="form-control mb-3 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" value="{{ old('keterangan', $produk->keterangan) }}" required></input>
            @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="hidden" name="oldGambar" value="{{ $produk->gambar }}">
                @if ($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" class="img-preview img-fluid mb-3 col-sm-1 d-block">
                @endif
                <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar"
                    value="{{ old('gambar') }}" onchange="previewGambar()">
                @error('gambar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/admin/produks" class="btn btn-danger">Kembali</a>
    </form>
    @include('admin.produks.previewGambar')
@endsection
