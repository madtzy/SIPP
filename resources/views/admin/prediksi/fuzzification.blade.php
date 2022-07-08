@extends('admin.layouts.main')
@section('content')
 <div class="row mb-5">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Fuzzification</h4>
                <p class="card-text">Persediaan</p>
                <ul>
                    <li>a : {{ $data->persediaan->a }}</li>
                    <li>b : {{ $data->persediaan->b }}</li>
                    <li>x : {{ $data->persediaan->x }}</li>
                </ul>
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>µ</th>
                            <th>Rumus</th>
                            <th>Jumlah</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">Banyak</td>
                            <td>
                                x - a / b - a
                            </td>
                            <td>
                                ( {{ $data->persediaan->x }} - {{ $data->persediaan->a }} )  / ( {{ $data->persediaan->b }} - {{ $data->persediaan->a }} )
                            </td>
                            <td>{{ round($data->persediaan->banyak ,2) }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Sedikit</td>
                            <td>
                                b - x / b - a
                            </td>
                            <td>
                                ( {{ $data->persediaan->b }} - {{ $data->persediaan->x }} )  / ( {{ $data->persediaan->b }} - {{ $data->persediaan->a }} )
                            </td>
                            <td>{{ round($data->persediaan->sedikit ,2) }}</td>
                        </tr>
                    </tbody>
                </table>

                <p class="card-text">Kualitas</p>
                <ul>
                    <li>a : {{ $data->kualitas->sedang_a1 }}</li>
                    <li>b : {{ $data->kualitas->bagus_b }}</li>
                    <li>x : {{ $data->kualitas->x }}</li>
                </ul>
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>µ</th>
                            <th>Rumus</th>
                            <th>Jumlah</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">Bagus</td>
                            <td>
                                x - a / b - a
                            </td>
                            <td>
                                ( {{ $data->kualitas->x }} - {{ $data->kualitas->bagus_a }} )  / ( {{ $data->kualitas->bagus_b }} - {{ $data->kualitas->bagus_a }} )
                            </td>
                            <td>{{ round($data->kualitas->bagus ,2) }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Sedang</td>
                            <td>
                               x - a / b - a
                            </td>
                            <td>
                                ( {{ $data->kualitas->x }} - {{ $data->kualitas->sedang_a1 }} )  / ( {{ $data->kualitas->sedang_b1 }} - {{ $data->kualitas->sedang_a1 }} )
                            </td>
                            <td>{{ round($data->kualitas->sedang[0] ,2) }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Sedang</td>
                            <td>
                               b - x / b - a
                            </td>
                            <td>
                                ( {{ $data->kualitas->sedang_b2 }} - {{ $data->kualitas->x }} )  / ( {{ $data->kualitas->sedang_b2 }} - {{ $data->kualitas->sedang_a2 }} )
                            </td>
                            <td>{{ round($data->kualitas->sedang[1] ,2) }}</td>
                        </tr>
                        <tr>
                            <td scope="row">Jelek</td>
                            <td>
                                b - x / b - a
                            </td>
                            <td>
                                ( {{ $data->kualitas->jelek_b }} - {{ $data->kualitas->x }} )  / ( {{ $data->kualitas->jelek_b }} - {{ $data->kualitas->jelek_a }} )
                            </td>
                            <td>{{ round($data->kualitas->jelek ,2) }}</td>
                        </tr>
                    </tbody>
                </table>

                <p class="card-text">Penjualan</p>
                <ul>
                    <li>a : {{ $data->penjualan->a }}</li>
                    <li>b : {{ $data->penjualan->b }}</li>
                    <li>x : ? </li>
                </ul>
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>µ</th>
                            <th>Rumus</th>
                            <th>Jumlah</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">Naik</td>
                            <td>
                                x - a / b - a
                            </td>
                            <td>
                                ( x - {{ $data->penjualan->a }} )  / ( {{ $data->penjualan->b }} - {{ $data->penjualan->a }} )
                            </td>
                            <td>
                            x - {{ $data->penjualan->a }}  / {{ $data->penjualan->b - $data->penjualan->a }}
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">Turun</td>
                            <td>
                                b - x / b - a
                            </td>
                            <td>
                                ( {{ $data->penjualan->b }} - x )  / ( {{ $data->penjualan->b }} - {{ $data->penjualan->a }} )
                            </td>
                            <td>
                                {{ $data->penjualan->b }} - x / {{ $data->penjualan->b - $data->penjualan->a }}
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Inference</h4>
                <p class="card-text">Kemudian mencari nilai x pada penjualan disetiap aturan rules menggunakan fungsi MIN</p>
                <div>
                    <h6><strong>R1</strong> = Persediaan Sedikit dan Kualitas Jelek maka Penjualan Turun</h6>
                    <p>
                      = µSedikit[x] ∩ µJelek[y] <br>
                      = MIN (µSedikit[x] ∩ µJelek[x]) <br>
                      = {{ round($data->inference->R1->z,2) }} <br>
                      <br>
                      µ(z1) = ( b - x ) / ( b - a ) <br>
                      {{ $data->inference->R1->data->min }} =  {{ $data->penjualan->b }} - x  / {{ $data->penjualan->b - $data->penjualan->a }} <br>
                      x = {{ round($data->inference->R1->x,2) }}
                    </p>
                </div>
                <div>
                    <h6><strong>R2</strong> = Persediaan Sedikit dan Kualitas Sedang maka Penjualan Turun</h6>
                    <p>
                      = µSedikit[x] ∩ µSedang[y] <br>
                      = MIN (µSedikit[] ∩ µSedang[]) <br>
                      = {{ round($data->inference->R2->z,2) }} <br>
                      <br>
                      µ(z2) = ( b - x ) / ( b - a ) <br>
                      {{ $data->inference->R2->data->min }} =  {{ $data->penjualan->b }} - x  / {{ $data->penjualan->b - $data->penjualan->a }} <br>
                      x = {{ round($data->inference->R2->x,2) }}
                    </p>
                </div>
                <div>
                    <h6><strong>R3</strong> = Persediaan Sedikit dan Kualitas Bagus maka Penjualan Naik</h6>
                    <p>
                      = µSedikit[x] ∩ µBagus[y] <br>
                      = MIN (µSedikit[] ∩ µBagus[]) <br>
                      = {{ round($data->inference->R3->z,2) }} <br>
                      <br>
                      µ(z3) = ( x - a ) / ( b - a ) <br>
                      {{ $data->inference->R3->data->min }} = x -  {{ $data->penjualan->a }}  / {{ $data->penjualan->b - $data->penjualan->a }} <br>
                      x = {{ round($data->inference->R3->x,2) }}
                    </p>
                </div>
                <div>
                    <h6><strong>R4</strong> = Persediaan Banyak dan Kualitas Jelek maka Penjualan Turun</h6>
                    <p>
                      = µBanyak[x] ∩ µJelek[y] <br>
                      = MIN (µBanyak[] ∩ µJelek[]) <br>
                      = {{ round($data->inference->R4->z,2) }} <br>
                      <br>
                      µ(z4) = ( b - x ) / ( b - a ) <br>
                      {{ $data->inference->R4->data->min }} =  {{ $data->penjualan->b }} - x  / {{ $data->penjualan->b - $data->penjualan->a }} <br>
                      x = {{ round($data->inference->R4->x,2) }}
                    </p>
                </div>
                <div>
                    <h6><strong>R5</strong> = Persediaan Banyak dan Kualitas Sedang maka Penjualan Naik</h6>
                    <p>
                      = µBanyak[x] ∩ µSedang[y] <br>
                      = MIN (µBanyak[] ∩ µSedang[]) <br>
                      = {{ round($data->inference->R5->z,2) }} <br>
                      <br>
                      µ(z5) = ( x - a ) / ( b - a ) <br>
                      {{ $data->inference->R5->data->min }} = x -  {{ $data->penjualan->a }}  / {{ $data->penjualan->b - $data->penjualan->a }} <br>
                      x = {{ round($data->inference->R5->x,2) }}
                    </p>
                </div>
                <div>
                    <h6><strong>R6</strong> = Persediaan Banyak dan Kualitas Bagus maka Penjualan Naik</h6>
                    <p>
                      = µBanyak[x] ∩ µBagus[y] <br>
                      = MIN (µBanyak[] ∩ µBagus[]) <br>
                      = {{ round($data->inference->R6->z,2) }} <br>
                      <br>
                      µ(z6) = ( x - a ) / ( b - a ) <br>
                      {{ $data->inference->R6->data->min }} = x -  {{ $data->penjualan->a }}  / {{ $data->penjualan->b - $data->penjualan->a }} <br>
                      x = {{ round($data->inference->R6->x,2) }}
                    </p>
                </div>

            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Defuzzyfikasi</h4>
                <p class="card-text">Kemudian mencari nilai rata-rata dari hasil inferensi</p>
                <div>
                    <p>
                        Z = ( (a1 * z1) + (a2 * z2) + (a3 * z3) + (a4 * z4) + (a5 * z5) + (a6 * z6) ) / ( a1 + a2 +  a3 + a4 +  a5 + a6 ) <br>
                        Z = ( @for ($i=0;$i<6;$i++) {{ round($data->hasil->z->a_z[$i],2)  }}  @if($i!=5) + @endif @endfor ) / ( @for ($i=0;$i<6;$i++) {{ round($data->hasil->z->a[$i],2)  }}  @if($i!=5) + @endif @endfor ) <br>
                        Z = {{ round($data->hasil->rata_rata,2) }}


                    </p>
                </div>
            </div>
        </div>
    </div>
 </div>

@endsection
