@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold mt-2"><i class='bx bx-sm bxs-user-plus me-3'></i>DATA KASIR</h4>
    <hr>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive">
        <a href="/admin/users/create" class="btn btn-sm btn-primary mb-3"><i class="fa-solid fa-plus me-2"></i>Tambah
            Data</a>
        <table id="table" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        {{-- loops --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->password }}</td>
                        <td>
                            <a href="/admin/users/{{ $user->id }}/edit" class="badge bg-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></span></a>
                            <a href="/admin/users/{{ $user->id }}" class="badge bg-danger" data-bs-toggle="modal"
                                data-bs-target="#hapus-{{ $user->id }}"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- modal hapus-->
        @foreach ($users as $user)
            <div class="modal fade" id="hapus-{{ $user->id }}" tabindex="-1" aria-labelledby="hapus_kasir"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="hapus_kasir">HAPUS KASIR</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah anda ingin menghapus data kasir tersebut ?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="/admin/users/{{ $user->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-sm btn-primary">
                                    HAPUS
                                </button>
                            </form>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
