@extends('admin.layouts.main')
@section('content')
    <h4 class="text-dark fw-bold mt-2"><i class='bx bx-sm bxs-dashboard me-3'></i>Dashboard </h4>
    @if (Auth::user()->is_admin == 1)
        <div class="row">
            <div class="col-4">
                <div class="card shadow py-2 bg-danger">
                    <div class="card-body bg-danger py-4">
                        <div class="row align-items-center">
                            <div class="col me-2">
                                <h5 class="fw-bold text-dark text-uppercase mb-1">TOTAL PENJUALAN</h5>
                                <h6 class="mt-3 text-dark">{{ $penjualan }} Karung</h6>

                            </div>
                            <div class="col-auto">
                                <i class='bx bx-lg bxs-shopping-bag'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow py-2 bg-warning">
                    <div class="card-body bg-warning py-4">
                        <div class="row align-items-center">
                            <div class="col me-2">
                                <h5 class="fw-bold text-dark text-uppercase mb-1">STOK AKHIR</h5>
                                <h6 class="mt-3 text-dark">{{ $stok }} Karung</h6>

                            </div>
                            <div class="col-auto">
                                <i class='bx bx-lg bxs-customize'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow py-2 bg-success">
                    <div class="card-body bg-success py-4">
                        <div class="row align-items-center">
                            <div class="col me-2">
                                <h5 class="fw-bold text-dark text-uppercase mb-1">PENGHASILAN</h5>
                                <h6 class="mt-3 text-dark">Rp. {{ $penghasilan }}</h6>

                            </div>
                            <div class="col-auto">
                                <i class='bx bx-lg bx-money-withdraw'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row mt-3">
                <div class="col">
                    <h5 class="text-center">Grafik Persediaan & Penjualan Tahun {{ $tahun }}</h5>
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="" class="form-label">Tahun</label>
                            <select class="form-control" name="" id="tahun">
                                @for ($i = 2021; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}"
                                        @if ($i == $tahun) selected="selected" @endif>{{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    {!! $chartjs->render() !!}
                </div>
            </div> --}}
    @else
        <div class="row">
            <div class="col-4">
                <div class="card shadow py-2 bg-success">
                    <div class="card-body bg-success py-4">
                        <div class="row align-items-center">
                            <div class="col me-2">
                                <h5 class="fw-bold text-dark text-uppercase mb-1">PESANAN DITERIMA</h5>
                                <h6 class="mt-3 text-dark">{{ $diterima }} Pesanan</h6>

                            </div>
                            <div class="col-auto">
                                <i class='bx bx-lg bxs-user-check'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow py-2 bg-warning">
                    <div class="card-body bg-warning py-4">
                        <div class="row align-items-center">
                            <div class="col me-2">
                                <h5 class="fw-bold text-dark text-uppercase mb-1">PESANAN DIPROSES</h5>
                                <h6 class="mt-3 text-dark">{{ $diproses }} Pesanan</h6>

                            </div>
                            <div class="col-auto">
                                <i class='bx bx-lg bxs-user-detail'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow py-2 bg-danger">
                    <div class="card-body bg-danger py-4">
                        <div class="row align-items-center">
                            <div class="col me-2">
                                <h5 class="fw-bold text-dark text-uppercase mb-1">PESANAN DITOLAK</h5>
                                <h6 class="mt-3 text-dark">{{ $ditolak }} Pesanan</h6>

                            </div>
                            <div class="col-auto">
                                <i class='bx bx-lg bxs-user-x'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        $('#tahun').on('change', function() {
            //ways to retrieve selected option and text outside handler
            // console.log('Changed option value ' + this.value);
            // console.log('Changed option text ' + );
            location.href = '?tahun=' + $(this).find('option').filter(':selected').val();
        });
    </script>
@endsection
