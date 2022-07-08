@extends('admin.layouts.main')
@section('content')
 <div class="row">
    <div class="col-lg-2">
        <form>
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <select class="form-select form-select-sm" id="tahun" name="tahun">
                <option selected="selected" disabled="disabled">Pilih Tahun</option>
                @for ($tahunIteration=2021;$tahunIteration<=date('Y');$tahunIteration++)
                    <option value="{{ $tahunIteration }}" @if($tahun==$tahunIteration) {{ 'selected="selected"' }} @endif>{{ $tahunIteration }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        </form>
    </div>
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data harian </h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered table-sm " id="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Persediaan</th>
                                <th>Kualitas</th>
                                <th>Penjualan</th>
                                <th>Prediksi</th>
                                <th>MAPE</th>
                                <th width="10">Lihat Metode</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($harian as $hari)
                            <tr>
                                <td>{{ $hari['tanggal'] }}</td>
                                <td>{{ $hari['persediaan'] }}</td>
                                <td>{{ $hari['kualitas'] }}</td>
                                <td>{{ $hari['penjualan'] }}</td>
                                <td>{{ round($hari['prediksi'],2) }}</td>
                                <td>{{ round($hari['mape'],4) }}</td>
                                <td class="text-center">
                                    <form action="{{ route('fuzzification') }}" method="post">
                                        @csrf
                                        <textarea class="d-none" name="data">{{ json_encode($hari['fuzzification']) }}</textarea>
                                        <button class="btn btn-sm btn-success">Detail</button>
                                    </form>

                                </td>
                            </tr>
                            @php
                            $total += round($hari['mape'],4);
                        @endphp
                        @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5">Total</th>
                                <th>{{ $total }}</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="5">Jumlah Data</th>
                                <th>{{ count($harian) }}</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="5">Akurasi %</th>
                                @php
                                $akurasi = 0;
                                if($harian) $akurasi = @($total / count($harian));
                                @endphp
                                <th>{{  round($akurasi,2) }}</th>
                                <th></th>
                            </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
