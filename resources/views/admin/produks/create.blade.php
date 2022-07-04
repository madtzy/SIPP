@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold">FORM TAMBAH PRODUK</h4>
    <hr>
    <form action="/admin/produks" method="post" class="mb-3 border-1" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
                value="{{ old('harga') }}" required>
            @error('harga')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok"
                value="{{ old('stok') }}" required>
            @error('stok')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control mb-3 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" value="{{ old('stok') }}" required></textarea>
            @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- <div class="mb-2">
            <label for="image" class="form-label">Post Image</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"
                value="{{ old('image') }}" onchange="previewImage()">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> --}}
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/admin/produks" class="btn btn-danger">Kembali</a>
    </form>
@endsection
