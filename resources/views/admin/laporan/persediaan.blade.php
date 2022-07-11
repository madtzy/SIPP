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
                <h5 class="card-title">Data Persediaan </h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered table-sm " id="table">
                        <thead>
                            <tr>
                                <th rowspan="2">Tanggal</th>
                                <th colspan="12">Bulan</th>
                            </tr>
                            <tr>
                                @for ($bulan=1;$bulan<=12;$bulan++)
                                    <th>{{ date('M', mktime(0, 0, 0, $bulan, 10)); }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @for ($tanggal=1;$tanggal<=31;$tanggal++)
                                <tr>
                                    <td class="text-center">{{ $tanggal }}</td>
                                    @for ($bulan=1;$bulan<=12;$bulan++)
                                        <td>@if($persediaan) {{ @$persediaan[$bulan][$tanggal] }}  @endif</td>
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
