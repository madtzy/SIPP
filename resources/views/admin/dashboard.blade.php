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
        <div class="row mt-5">
            <div class="col">
                <h5 class="text-center">Data Persediaan & Penjualan Tahun {{ $tahun }}</h5>
                <div class="row">
                    <div class=" col-3 mb-3">
                    <label for="" class="form-label">Tahun</label>
                    <select class="form-control" name="" id="tahun">
                        @for ($i=2021;$i<=date('Y');$i++)
                            <option value="{{ $i }}" @if ($i==$tahun)
                                selected="selected"
                            @endif>{{ $i }}</option>
                        @endfor
                    </select>
                    </div>
                </div>
                {!! $chartjs->render() !!}
            </div>
        </div>
    </div>
    <script>
        $('#tahun').on('change', function () {
        //ways to retrieve selected option and text outside handler
        // console.log('Changed option value ' + this.value);
        // console.log('Changed option text ' + );
            location.href='?tahun='+ $(this).find('option').filter(':selected').val();
        });
    </script>
@endsection
