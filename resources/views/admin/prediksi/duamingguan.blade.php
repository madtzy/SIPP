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
        @if ($tahun)
            <div class="d-grid gap-2 mt-1">
                <button type="button" class="btn btn-success btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Prediksi Data
                </button>
            </div>
        @endif
    </div>
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Prediksi 14 Hari</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered table-sm " id="table">
                        <thead>
                            <tr>
                                <th>No</th>
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
                        @foreach ($mingguan as $minggu)
                            <tr>
                                <td>{{ $minggu['minggu'] }}</td>
                                <td>{{ $minggu['persediaan'] }}</td>
                                <td>{{ $minggu['kualitas'] }}</td>
                                <td>{{ $minggu['penjualan'] }}</td>
                                <td>{{ round($minggu['prediksi'],2) }}</td>
                                <td>{{ round($minggu['mape'],4) }}</td>
                                <td class="text-center">
                                    <form action="{{ route('fuzzification') }}" method="post">
                                        @csrf
                                        <textarea class="d-none" name="data">{{ json_encode($minggu['fuzzification']) }}</textarea>
                                        <button class="btn btn-sm btn-success">Detail</button>
                                    </form>

                                </td>
                            </tr>
                            @php
                            $total += round($minggu['mape'],4);
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
                                <th>{{ count($mingguan) }}</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="5">Akurasi %</th>
                                @php
                                $akurasi = 0;
                                if($mingguan) $akurasi = @($total / count($mingguan));
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Prediksi Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('prediksi.duamingguan.manual')  }}">
        <input type="hidden" name="tahun" value="{{ $tahun }}">

        <div class="modal-body">
                <div class="mb-3">
                    <label for="" class="form-label">Persediaan</label>
                    <input type="number" name="persediaan" id="" class="form-control" required="required">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kualitas</label>
                    <input type="number" name="kualitas" id="" class="form-control" required="required">
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Kirim Data</button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
