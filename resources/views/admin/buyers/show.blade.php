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
                                {{ $buyer->produk->harga }}
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
                                {{ $buyer->total_bayar }}
                            </td>
                        </tr>
                        <tr class="d-block">
                            <td>Status</td>
                            <td>:</td>
                            <td>
                                <div class="badge {{ $buyer->status == 'terima' ? 'bg-success' : 'bg-danger' }}">{{ $buyer->status }}</div>
                            </td>
                        </tr>
                    </table>
                     @if($buyer->status=="belum_diproses")
                    <form action="{{ route('buyers.update', $buyer->id)}}" method="post" class="d-inline">
                        @method('put')
                        @csrf
                        <input type="hidden" name="status" value="terima">
                        <button class="btn btn-sm btn-success border-0"
                            onclick="return confirm('Apakah Anda Ingin Menerima Pesanan Ini ?')">
                            Terima Pesanan
                        </button>
                    </form>
                    <form action="{{ route('buyers.update', $buyer->id)}}" method="post" class="d-inline">
                        @method('put')
                        @csrf
                        <input type="hidden" name="status" value="tolak">
                        <button class="btn btn-sm btn-danger border-0"
                            onclick="return confirm('Apakah Anda Ingin Menolak Pesanan Ini ?')">
                            Tolak Pesanan
                        </button>
                    </form>
                    <br><br>
                    @endif
                    <a href="/admin/buyers/list/{{ $buyer->status }}" class="btn btn-sm btn-danger mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
