@extends('admin.layouts.main')
@section('content')
    <div class="card col-md-8">
        <div class="card-header fw-bold bg-primary">DETAIL PESANAN</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('storage/' . $buyer->produk->gambar) }}" class=" gambar" style="align-self: center;">
                </div>
                <div class="col-md-9">
                    <table class="table">
                        <tr class="d-block">
                            <td>Nama</td>
                            <td>:</td>
                            <td>
                                {{ $buyer->produk->nama }}
                            </td>
                        </tr>
                        <tr class="d-block">
                            <td>Harga</td>
                            <td>:</td>
                            <td>
                                Rp. {{ $buyer->produk->harga }}
                            </td>
                        </tr>
                        <tr class="d-block">
                            <td>Jumlah</td>
                            <td>:</td>
                            <td>
                                {{ $buyer->jumlah }}
                            </td>
                        </tr>
                        <tr class="d-block">
                            <td>Total Bayar</td>
                            <td>:</td>
                            <td>
                                Rp. {{ $buyer->total_bayar }}
                            </td>
                        </tr>
                        <tr class="d-block">
                            <td>Status</td>
                            <td>:</td>
                            <td>
                                @if ($buyer->status == 'belum_diproses')
                                    <button class="badge bg-warning border-0 text-dark" data-bs-toggle="modal"
                                        data-bs-target="#verifikasi-{{ $buyer->id }}">Pending</button>
                                @else
                                    <div class="badge {{ $buyer->status == 'terima' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $buyer->status }}</div>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <a href="/admin/buyers/list/{{ $buyer->status }}" class="btn btn-sm btn-danger mt-3">Kembali</a>
                    {{-- modal verfikasi --}}
                    <div class="modal fade" id="verifikasi-{{ $buyer->id }}" tabindex="-1"
                        aria-labelledby="terima_pesanan" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="terima_pesanan">VERIFIKASI DATA PESANAN</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda Ingin Memverifikasi Data Pemesan Ini ?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('buyers.update', $buyer->id) }}" method="post"
                                        class="d-inline">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="status" value="terima">
                                        <button class="btn btn-sm btn-primary border-0">
                                            Terima
                                        </button>
                                    </form>
                                    <form action="{{ route('buyers.update', $buyer->id) }}" method="post"
                                        class="d-inline">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="status" value="tolak">
                                        <button class="btn btn-sm btn-danger border-0">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
