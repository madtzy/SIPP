@extends('admin.layouts.main')
@section('content')
    <div class="col-md-8">
        <h4 class="text-dark fw-bold">FORM EDIT STOK PRODUK</h4>
        <hr>
        <form action="{{ route('stoks.update',$stok->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-2">
                <label for="produk_id" class="form-label">Nama</label>
                <select class="form-control select2  @error('produk_id') is-invalid @enderror" name="produk_id" id="produk_id">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @if ($product->id==old('produk_id',$stok->produk_id))
                            selected='selected'
                        @endif>{{ $product->nama }}</option>
                    @endforeach
                </select>
                @error('produk_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal"
                    value="{{ (old('tanggal',$stok->tanggal))? old('tanggal',$stok->tanggal) : date('Y-m-d')  }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="kualitas" class="form-label">Kualitas</label>
                <input type="number" class="form-control @error('kualitas') is-invalid @enderror" id="kualitas" name="kualitas" min="0" max="100"
                    value="{{ old('kualitas',$stok->kualitas) }}" required>
                @error('kualitas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" min="1" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok"
                    value="{{ old('stok',$stok->stok) }}" required>
                @error('stok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/admin/stoks" class="btn btn-danger">Kembali</a>
        </form>
    </div>
@endsection
