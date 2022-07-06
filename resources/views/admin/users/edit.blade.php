@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold">FORM EDIT KASIR</h4>
    <hr>
    <form action="/admin/users/{{ $user->id }}" method="post" class="mb-3 border-1" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-2">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                value="{{ old('nama', $user->nama) }}" required>
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                name="username" value="{{ old('username', $user->username) }}" required>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" value="{{ old('password', $user->password) }}" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/admin/users" class="btn btn-danger">Kembali</a>
    </form>
@endsection
