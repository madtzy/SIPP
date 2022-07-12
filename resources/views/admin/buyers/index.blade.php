@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold mt-2"><i class='bx bx-sm bxs-cart me-3'></i>DATA PEMESAN</h4>
    <hr>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive">
        <table id="table" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buyers as $buyer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $buyer->nama }}</td>
                        <td>{{ $buyer->alamat }}</td>
                        <td>{{ $buyer->nomor_telp }}</td>
                        <td>{{ $buyer->tanggal }}</td>
                        <td>
                            @if ($buyer->status == 'belum_diproses')
                                <button class="badge bg-warning border-0" data-bs-toggle="modal"
                                    data-bs-target="#verifikasi-{{ $buyer->id }}">Pending</button>
                                {{-- <button class="badge bg-success border-0" data-bs-toggle="modal"
                                    data-bs-target="#terima-{{ $buyer->id }}">Terima Pesanan</button>
                                <button class="badge bg-danger border-0" data-bs-toggle="modal"
                                    data-bs-target="#tolak-{{ $buyer->id }}">Tolak Pesanan</button> --}}
                            @else
                                <div class="badge {{ $buyer->status == 'terima' ? 'bg-success' : 'bg-danger' }}">{{ $buyer->status }}</div>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/buyers/{{ $buyer->id }}" class="badge bg-success"><i
                                    class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- modal terima --}}
        @foreach ($buyers as $buyer)
            <div class="modal fade" id="verifikasi-{{ $buyer->id }}" tabindex="-1" aria-labelledby="terima_pesanan"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="terima_pesanan">VERIFIKASI DATA PESANAN</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda Ingin Memverifikasi Data Pemesan Ini ?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('buyers.update', $buyer->id) }}" method="post" class="d-inline">
                                @method('put')
                                @csrf
                                <input type="hidden" name="status" value="terima">
                                <button class="btn btn-sm btn-primary border-0">
                                    Terima
                                </button>
                            </form>
                            <form action="{{ route('buyers.update', $buyer->id) }}" method="post" class="d-inline">
                                @method('put')
                                @csrf
                                <input type="hidden" name="status" value="tolak">
                                <button class="btn btn-sm btn-danger border-0">
                                    Tolak
                                </button>
                            </form>
                            {{-- <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- modal terima --}}
        {{-- @foreach ($buyers as $buyer)
            <div class="modal fade" id="terima-{{ $buyer->id }}" tabindex="-1" aria-labelledby="terima_pesanan"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="terima_pesanan">VERIFIKASI DATA PESANAN</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda Ingin Menerima Pesanan Ini ?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('buyers.update', $buyer->id) }}" method="post" class="d-inline">
                                @method('put')
                                @csrf
                                <input type="hidden" name="status" value="terima">
                                <button class="btn btn-sm btn-primary border-0">
                                    Terima
                                </button>
                            </form>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach --}}
        {{-- modal tolak --}}
        {{-- @foreach ($buyers as $buyer)
            <div class="modal fade" id="tolak-{{ $buyer->id }}" tabindex="-1" aria-labelledby="tolak_pesanan"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="tolak_pesanan">VERIFIKASI DATA PESANAN</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda Ingin Menolak Pesanan Ini ?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('buyers.update', $buyer->id) }}" method="post" class="d-inline">
                                @method('put')
                                @csrf
                                <input type="hidden" name="status" value="tolak">
                                <button class="btn btn-sm btn-primary border-0">
                                    Tolak
                                </button>
                            </form>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach --}}
    </div>
@endsection
