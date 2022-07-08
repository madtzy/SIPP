<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

    const SEDIKIT = 'SEDIKIT';
    const JELEK = 'JELEK';
    const TURUN = 'TURUN';
    const SEDANG = 'SEDANG';
    const BAGUS = 'BAGUS';
    const CEPAT = 'CEPAT';
    const BANYAK = 'BANYAK';
    const R1 = [
        SEDIKIT,JELEK,TURUN
    ];

    const R2 = [
        SEDIKIT,SEDANG,TURUN
    ];

    const R3 = [
        SEDIKIT,BAGUS,CEPAT
    ];

    const R4 = [
        BANYAK,JELEK,TURUN
    ];

    const R5 = [
        BANYAK,SEDANG,CEPAT
    ];
    const R6 = [
        BANYAK,BAGUS,CEPAT
    ];

class PrediksiController extends Controller
{

    public function fuzzification(Request $request){
        $data = $request->data;
        return view('admin.prediksi.fuzzification', [
            'title' => 'Fuzzyfication',
            'data' => json_decode($data)
        ]);
    }

    //
    public function harian(Request $request)
    {
        $tahun = $request->get('tahun');
        $persediaan_minmax = DB::select('select * from persediaan_minmax where tahun = ?',[$tahun]);
        $penjualan_minmax = DB::select('select * from penjualan_minmax where tahun = ?',[$tahun]);
        $kualitas_minmax = DB::select('select * from kualitas_minmax where tahun = ?',[$tahun]);

        if($persediaan_minmax) $persediaan_minmax = $persediaan_minmax[0];
        if($penjualan_minmax) $penjualan_minmax = $penjualan_minmax[0];
        if($kualitas_minmax) $kualitas_minmax = $kualitas_minmax[0];

        $dataHarian = DB::select('select * from harian where year(tanggal) = ?',[$tahun]);
        $dataHarianFinal = [];
        foreach($dataHarian as $data){
            $dataHasil = [
                'persediaan_a' => $persediaan_minmax->harian_persediaan_min,
                'persediaan_b' => $persediaan_minmax->harian_persediaan_max,
                'persediaan_x' => $data->persediaan,
                'kualitas_bagus_a' => $kualitas_minmax->harian_kualitas_sedang,
                'kualitas_bagus_b' => $kualitas_minmax->harian_kualitas_bagus,
                'kualitas_sedang_a1' => $kualitas_minmax->harian_kualitas_jelek,
                'kualitas_sedang_b1' => $kualitas_minmax->harian_kualitas_sedang,
                'kualitas_sedang_a2' => $kualitas_minmax->harian_kualitas_sedang,
                'kualitas_sedang_b2' => $kualitas_minmax->harian_kualitas_bagus,
                'kualitas_jelek_a' => $kualitas_minmax->harian_kualitas_jelek,
                'kualitas_jelek_b' => $kualitas_minmax->harian_kualitas_sedang,
                'kualitas_x' => $data->kualitas,
                'penjualan_a' => $penjualan_minmax->harian_penjualan_min,
                'penjualan_b' => $penjualan_minmax->harian_penjualan_max,
                'penjualan_x' => $data->penjualan
            ];

            $fuzzification = $this->getFuzzyfication($dataHasil);
            $dataHarianFinal[] = [
                'tanggal'=>$data->tanggal,
                'persediaan'=>$data->persediaan,
                'kualitas'=>$data->kualitas,
                'penjualan'=>$data->penjualan,
                'variable'=>$dataHasil,
                'fuzzification'=>$fuzzification,
                'prediksi'=>$fuzzification['hasil']['rata_rata'],
                'mape'=>(abs($data->penjualan-$fuzzification['hasil']['rata_rata'])/$data->penjualan) * 100
            ];

        }

        return view('admin.prediksi.harian', [
            'title' => 'Prediksi harian',
            'harian' => $dataHarianFinal,
            'tahun'=>$tahun
        ]);
    }

    public function mingguan(Request $request)
    {
        $tahun = $request->get('tahun');
        $dataMingguanRecord = DB::select('select * from mingguan where tahun = ?',[$tahun]);
        $dataMingguan = [];
        $minggu=1;
        foreach($dataMingguanRecord as $mingguan){
            for ($i=1; $i <= 4; $i++) {
                $dataMinggu = (array)  $mingguan;
                $dataMingguan[] = [
                    "tahun"=>$mingguan->tahun,
                    "bulan"=>$mingguan->bulan,
                    "minggu"=>$minggu,
                    "persediaan"=>$dataMinggu['persediaan_minggu_'.$i],
                    "kualitas"=>$dataMinggu['kualitas_minggu_'.$i],
                    "penjualan"=>$dataMinggu['penjualan_minggu_'.$i],
                ];
                $minggu++;
            }
        }

        $persediaan_minmax = DB::select('select * from persediaan_minmax where tahun = ?',[$tahun]);
        $penjualan_minmax = DB::select('select * from penjualan_minmax where tahun = ?',[$tahun]);
        $kualitas_minmax = DB::select('select * from kualitas_minmax where tahun = ?',[$tahun]);

        if($persediaan_minmax) $persediaan_minmax = $persediaan_minmax[0];
        if($penjualan_minmax) $penjualan_minmax = $penjualan_minmax[0];
        if($kualitas_minmax) $kualitas_minmax = $kualitas_minmax[0];

        $dataMingguanFinal = [];
        foreach($dataMingguan as $data){
            $dataHasil = [
                'persediaan_a' => $persediaan_minmax->mingguan_persediaan_min,
                'persediaan_b' => $persediaan_minmax->mingguan_persediaan_max,
                'persediaan_x' => $data['persediaan'],
                'kualitas_bagus_a' => $kualitas_minmax->mingguan_kualitas_sedang,
                'kualitas_bagus_b' => $kualitas_minmax->mingguan_kualitas_bagus,
                'kualitas_sedang_a1' => $kualitas_minmax->mingguan_kualitas_jelek,
                'kualitas_sedang_b1' => $kualitas_minmax->mingguan_kualitas_sedang,
                'kualitas_sedang_a2' => $kualitas_minmax->mingguan_kualitas_sedang,
                'kualitas_sedang_b2' => $kualitas_minmax->mingguan_kualitas_bagus,
                'kualitas_jelek_a' => $kualitas_minmax->mingguan_kualitas_jelek,
                'kualitas_jelek_b' => $kualitas_minmax->mingguan_kualitas_sedang,
                'kualitas_x' => $data['kualitas'],
                'penjualan_a' => $penjualan_minmax->mingguan_penjualan_min,
                'penjualan_b' => $penjualan_minmax->mingguan_penjualan_max,
                'penjualan_x' => $data['penjualan']
            ];

            $fuzzification = $this->getFuzzyfication($dataHasil);
            $data = (object) $data;
            $dataMingguanFinal[] = [
                'minggu'=>$data->minggu,
                'persediaan'=>$data->persediaan,
                'kualitas'=>$data->kualitas,
                'penjualan'=>$data->penjualan,
                'variable'=>$dataHasil,
                'fuzzification'=>$fuzzification,
                'prediksi'=>$fuzzification['hasil']['rata_rata'],
                'mape'=>(abs($data->penjualan-$fuzzification['hasil']['rata_rata'])/$data->penjualan) * 100
            ];

        }

        return view('admin.prediksi.mingguan', [
            'title' => 'Prediksi mingguan',
            'mingguan' => $dataMingguanFinal,
            'tahun'=>$tahun
        ]);
    }

    public function duamingguan(Request $request)
    {
        $tahun = $request->get('tahun');
        $dataMingguanRecord = DB::select('select * from dua_mingguan where tahun = ?',[$tahun]);
        $dataMingguan = [];
        $minggu=1;
        foreach($dataMingguanRecord as $mingguan){
            for ($i=1; $i <= 2; $i++) {
                $dataMinggu = (array)  $mingguan;
                $dataMingguan[] = [
                    "tahun"=>$mingguan->tahun,
                    "bulan"=>$mingguan->bulan,
                    "minggu"=>$minggu,
                    "persediaan"=>$dataMinggu['persediaan_duaminggu_'.$i],
                    "kualitas"=>$dataMinggu['kualitas_duaminggu_'.$i],
                    "penjualan"=>$dataMinggu['penjualan_duaminggu_'.$i],
                ];
                $minggu++;
            }
        }

        $persediaan_minmax = DB::select('select * from persediaan_minmax where tahun = ?',[$tahun]);
        $penjualan_minmax = DB::select('select * from penjualan_minmax where tahun = ?',[$tahun]);
        $kualitas_minmax = DB::select('select * from kualitas_minmax where tahun = ?',[$tahun]);

        if($persediaan_minmax) $persediaan_minmax = $persediaan_minmax[0];
        if($penjualan_minmax) $penjualan_minmax = $penjualan_minmax[0];
        if($kualitas_minmax) $kualitas_minmax = $kualitas_minmax[0];

        $dataMingguanFinal = [];
        foreach($dataMingguan as $data){
            $dataHasil = [
                'persediaan_a' => $persediaan_minmax->dua_mingguan_persediaan_min,
                'persediaan_b' => $persediaan_minmax->dua_mingguan_persediaan_max,
                'persediaan_x' => $data['persediaan'],
                'kualitas_bagus_a' => $kualitas_minmax->dua_mingguan_kualitas_sedang,
                'kualitas_bagus_b' => $kualitas_minmax->dua_mingguan_kualitas_bagus,
                'kualitas_sedang_a1' => $kualitas_minmax->dua_mingguan_kualitas_jelek,
                'kualitas_sedang_b1' => $kualitas_minmax->dua_mingguan_kualitas_sedang,
                'kualitas_sedang_a2' => $kualitas_minmax->dua_mingguan_kualitas_sedang,
                'kualitas_sedang_b2' => $kualitas_minmax->dua_mingguan_kualitas_bagus,
                'kualitas_jelek_a' => $kualitas_minmax->dua_mingguan_kualitas_jelek,
                'kualitas_jelek_b' => $kualitas_minmax->dua_mingguan_kualitas_sedang,
                'kualitas_x' => $data['kualitas'],
                'penjualan_a' => $penjualan_minmax->dua_mingguan_penjualan_min,
                'penjualan_b' => $penjualan_minmax->dua_mingguan_penjualan_max,
                'penjualan_x' => $data['penjualan']
            ];

            $fuzzification = $this->getFuzzyfication($dataHasil);
            $data = (object) $data;
            $dataMingguanFinal[] = [
                'minggu'=>$data->minggu,
                'persediaan'=>$data->persediaan,
                'kualitas'=>$data->kualitas,
                'penjualan'=>$data->penjualan,
                'variable'=>$dataHasil,
                'fuzzification'=>$fuzzification,
                'prediksi'=>$fuzzification['hasil']['rata_rata'],
                'mape'=>(abs($data->penjualan-$fuzzification['hasil']['rata_rata'])/$data->penjualan) * 100
            ];
        }

        return view('admin.prediksi.duamingguan', [
            'title' => 'Prediksi duamingguan',
            'mingguan' => $dataMingguanFinal,
            'tahun'=>$tahun
        ]);
    }

    public function bulanan(Request $request)
    {
        $tahun = $request->get('tahun');
        $persediaan_minmax = DB::select('select * from persediaan_minmax where tahun = ?',[$tahun]);
        $penjualan_minmax = DB::select('select * from penjualan_minmax where tahun = ?',[$tahun]);
        $kualitas_minmax = DB::select('select * from kualitas_minmax where tahun = ?',[$tahun]);
        if($persediaan_minmax) $persediaan_minmax = $persediaan_minmax[0];
        if($penjualan_minmax) $penjualan_minmax = $penjualan_minmax[0];
        if($kualitas_minmax) $kualitas_minmax = $kualitas_minmax[0];

        $dataBulanan = DB::select('select * from bulanan where tahun = ?',[$tahun]);
        $dataBulananFinal = [];
        foreach($dataBulanan as $data){
                $dataHasil = [
                    'persediaan_a' => $persediaan_minmax->bulanan_persediaan_min,
                    'persediaan_b' => $persediaan_minmax->bulanan_persediaan_max,
                    'persediaan_x' => $data->persediaan,
                    'kualitas_bagus_a' => $kualitas_minmax->bulanan_kualitas_sedang,
                    'kualitas_bagus_b' => $kualitas_minmax->bulanan_kualitas_bagus,
                    'kualitas_sedang_a1' => $kualitas_minmax->bulanan_kualitas_jelek,
                    'kualitas_sedang_b1' => $kualitas_minmax->bulanan_kualitas_sedang,
                    'kualitas_sedang_a2' => $kualitas_minmax->bulanan_kualitas_sedang,
                    'kualitas_sedang_b2' => $kualitas_minmax->bulanan_kualitas_bagus,
                    'kualitas_jelek_a' => $kualitas_minmax->bulanan_kualitas_jelek,
                    'kualitas_jelek_b' => $kualitas_minmax->bulanan_kualitas_sedang,
                    'kualitas_x' => $data->kualitas,
                    'penjualan_a' => $penjualan_minmax->bulanan_penjualan_min,
                    'penjualan_b' => $penjualan_minmax->bulanan_penjualan_max,
                    'penjualan_x' => $data->penjualan
                ];

                $fuzzification = $this->getFuzzyfication($dataHasil);
                $dataBulananFinal[] = [
                    'bulan'=>$data->bulan,
                    'persediaan'=>$data->persediaan,
                    'kualitas'=>$data->kualitas,
                    'penjualan'=>$data->penjualan,
                    'variable'=>$dataHasil,
                    'fuzzification'=>$fuzzification,
                    'prediksi'=>$fuzzification['hasil']['rata_rata'],
                    'mape'=>(abs($data->penjualan-$fuzzification['hasil']['rata_rata'])/$data->penjualan) * 100
                ];
        }

        return view('admin.prediksi.bulanan', [
            'title' => 'Prediksi bulanan',
            'bulanan' => $dataBulananFinal,
            'tahun'=>$tahun
        ]);
    }

    public function highOrder($a,$b,$z1)
    {
        return ($z1*($b-$a))+$a;
    }

    public function lowOrder($a,$b,$z1)
    {
        return $b-$z1*($b-$a);
    }

    public function lowOrderFormula($a,$b,$z1)
    {
        return $b."-".$z1."*(".$b."-".$a.")";
    }

    public function highOrderFormula($a,$b,$z1)
    {
        return $z1."*(".$b."-".$a.")+".$a;
    }

    public function rendering()
    {
        try {
            $data = [
                'persediaan_a' => 20,
                'persediaan_b' => 60,
                'persediaan_x' => 32,
                'kualitas_bagus_a' => 80,
                'kualitas_bagus_b' => 100,
                'kualitas_sedang_a1' => 60,
                'kualitas_sedang_b1' => 80,
                'kualitas_sedang_a2' => 80,
                'kualitas_sedang_b2' => 100,
                'kualitas_jelek_a' => 60,
                'kualitas_jelek_b' => 80,
                'kualitas_x' => 75,
                'penjualan_a' => 1,
                'penjualan_b' => 40,
                'penjualan_x' => 0
            ];

            $fuzzification = $this->getFuzzyfication($data);
            echo json_encode($fuzzification);
        } catch (\Throwable $th) {
            throw $th;
        }

    }


    public function getFuzzyfication($data)
    {
        /**
         * Persediaan
         * a = min, b = max, x = ?
         */
        $persediaan_a = $data['persediaan_a'];
        $persediaan_b = $data['persediaan_b'];
        $persediaan_x = $data['persediaan_x'];

        $persediaan_banyak = ($persediaan_x-$persediaan_a)/($persediaan_b-$persediaan_a);
        $persediaan_sedikit = ($persediaan_b-$persediaan_x)/($persediaan_b-$persediaan_a);
        $persediaan_banyak = ($persediaan_banyak<0 || $persediaan_banyak>1)? 0 : $persediaan_banyak;
        $persediaan_sedikit = ($persediaan_sedikit<0 || $persediaan_sedikit>1)? 0 : $persediaan_sedikit;
         /**
         * Kualitas
         * a = min, b = max, x = ?
         */
        $kualitas_bagus_a = $data['kualitas_bagus_a'];
        $kualitas_bagus_b = $data['kualitas_bagus_b'];
        $kualitas_sedang_a1 = $data['kualitas_sedang_a1'];
        $kualitas_sedang_b1 = $data['kualitas_sedang_b1'];
        $kualitas_sedang_a2 = $data['kualitas_sedang_a2'];
        $kualitas_sedang_b2 = $data['kualitas_sedang_b2'];
        $kualitas_jelek_a = $data['kualitas_jelek_a'];
        $kualitas_jelek_b = $data['kualitas_jelek_b'];
        $kualitas_x = $data['kualitas_x'];

        $kualitas_bagus = ($kualitas_x-$kualitas_bagus_a)/($kualitas_bagus_b-$kualitas_bagus_a);
        $kualitas_sedang_a = ($kualitas_x-$kualitas_sedang_a1)/($kualitas_sedang_b1-$kualitas_sedang_a1);
        $kualitas_sedang_b = ($kualitas_sedang_b2-$kualitas_x)/($kualitas_sedang_b2-$kualitas_sedang_a2);
        $kualitas_jelek = ($kualitas_jelek_b-$kualitas_x)/($kualitas_jelek_b-$kualitas_jelek_a);

        $kualitas_bagus = ($kualitas_bagus<0 || $kualitas_bagus>1)? 0 : $kualitas_bagus;
        $kualitas_sedang_a = ($kualitas_sedang_a<0 || $kualitas_sedang_a>1)? 0 : $kualitas_sedang_a;
        $kualitas_sedang_b = ($kualitas_sedang_b<0 || $kualitas_sedang_b>1)? 0 : $kualitas_sedang_b;
        $kualitas_jelek = ($kualitas_jelek<0 || $kualitas_jelek>1)? 0 : $kualitas_jelek;


        /**
         * Penjualan
         */

        $penjualan_a = $data['penjualan_a'];
        $penjualan_b = $data['penjualan_b'];
        $penjualan_x = $data['penjualan_x'];


        // Inference
        /**
         * R1
         * a = min, b = max, x = ?
         */
        $r1_z = min([$persediaan_sedikit,$kualitas_jelek]);
        $r1_x = $this->lowOrder($penjualan_a,$penjualan_b,$r1_z);
        $r1_formula = $this->lowOrderFormula($penjualan_a,$penjualan_b,$r1_z);
        $r1_data = [
            'min' => $r1_z,
            'formula' => $r1_formula
        ];
        $defuzzyfikasi_az[] = $r1_z*$r1_x;
        $defuzzyfikasi_a[] = $r1_z;

        /**
         * R2
         * a = min, b = max, x = ?
         */
        $r2_z = min([$persediaan_sedikit,$kualitas_sedang_a,$kualitas_sedang_b]);
        $r2_x = $this->lowOrder($penjualan_a,$penjualan_b,$r2_z);
        $r2_formula = $this->lowOrderFormula($penjualan_a,$penjualan_b,$r2_z);
        $r2_data = [
            'min' => $r2_z,
            'formula' => $r2_formula
        ];
        $defuzzyfikasi_az[] = $r2_z*$r2_x;
        $defuzzyfikasi_a[] = $r2_z;


        /**
         * R3
         * a = min, b = max, x = ?
         */
        $r3_z = min([$persediaan_sedikit,$kualitas_bagus]);
        $r3_x = $this->highOrder($penjualan_a,$penjualan_b,$r3_z);
        $r3_formula = $this->highOrderFormula($penjualan_a,$penjualan_b,$r3_z);
        $r3_data = [
            'min' => $r3_z,
            'formula' => $r3_formula
        ];
        $defuzzyfikasi_az[] = $r3_z*$r3_x;
        $defuzzyfikasi_a[] = $r3_z;


        /**
         * R4
         * a = min, b = max, x = ?
         */
        $r4_z = min([$persediaan_banyak,$kualitas_jelek]);
        $r4_x = $this->lowOrder($penjualan_a,$penjualan_b,$r4_z);
        $r4_formula = $this->lowOrderFormula($penjualan_a,$penjualan_b,$r4_z);
        $r4_data = [
            'min' => $r4_z,
            'formula' => $r4_formula
        ];
        $defuzzyfikasi_az[] = $r4_z*$r4_x;
        $defuzzyfikasi_a[] = $r4_z;

        /**
         * R5
         * a = min, b = max, x = ?
         */
        $r5_z = min([$persediaan_sedikit,$kualitas_sedang_a,$kualitas_sedang_b]);
        $r5_x = $this->highOrder($penjualan_a,$penjualan_b,$r5_z);
        $r5_formula = $this->highOrderFormula($penjualan_a,$penjualan_b,$r5_z);
        $r5_data = [
            'min' => $r5_z,
            'formula' => $r5_formula
        ];
        $defuzzyfikasi_az[] = $r5_z*$r5_x;
        $defuzzyfikasi_a[] = $r5_z;

        /**
         * R6
         * a = min, b = max, x = ?
         */
        $r6_z = min([$persediaan_banyak,$kualitas_bagus]);
        $r6_x = $this->highOrder($penjualan_a,$penjualan_b,$r6_z);
        $r6_formula = $this->highOrderFormula($penjualan_a,$penjualan_b,$r6_z);
        $r6_data = [
            'min' => $r6_z,
            'formula' => $r6_formula
        ];
        $defuzzyfikasi_az[] = $r6_z*$r6_x;
        $defuzzyfikasi_a[] = $r6_z;



        $data = [
            'persediaan'=> [
                'a'=>$persediaan_a,
                'b'=>$persediaan_b,
                'x'=>$persediaan_x,
                'banyak'=>$persediaan_banyak,
                'sedikit'=>$persediaan_sedikit
            ],
            'kualitas'=>[
                'bagus_a'=>$kualitas_bagus_a,
                'bagus_b'=>$kualitas_bagus_b,
                'sedang_a1'=>$kualitas_sedang_a1,
                'sedang_b1'=>$kualitas_sedang_b1,
                'sedang_a2'=>$kualitas_sedang_a2,
                'sedang_b2'=>$kualitas_sedang_b2,
                'jelek_a'=>$kualitas_jelek_a,
                'jelek_b'=>$kualitas_jelek_b,
                'x'=>$kualitas_x,
                'bagus'=>$kualitas_bagus,
                'sedang'=>[
                    $kualitas_sedang_a,
                    $kualitas_sedang_b,
                ],
                'jelek'=>$kualitas_jelek,
            ],
            'penjualan'=>[
                'a'=>$penjualan_a,
                'b'=>$penjualan_b,
                'x'=>$penjualan_x,
            ],
            'inference'=>[
                'R1'=>[
                    'aturan'=>R1,
                    'data'=>$r1_data,
                    'z'=>$r1_z,
                    'x'=>$r1_x
                ],
                'R2'=>[
                    'aturan'=>R2,
                    'data'=>$r2_data,
                    'z'=>$r2_z,
                    'x'=>$r2_x
                ],
                'R3'=>[
                    'aturan'=>R3,
                    'data'=>$r3_data,
                    'z'=>$r3_z,
                    'x'=>$r3_x
                ],
                'R4'=>[
                    'aturan'=>R4,
                    'data'=>$r4_data,
                    'z'=>$r4_z,
                    'x'=>$r4_x
                ],
                'R5'=>[
                    'aturan'=>R5,
                    'data'=>$r5_data,
                    'z'=>$r5_z,
                    'x'=>$r5_x
                ],
                'R6'=>[
                    'aturan'=>R6,
                    'data'=>$r6_data,
                    'z'=>$r6_z,
                    'x'=>$r6_x
                ],
            ],
            'hasil'=>[
                'z'=>[
                    'a_z'   => $defuzzyfikasi_az,
                    'a'     => $defuzzyfikasi_a,
                ],
                'rata_rata'=> array_sum($defuzzyfikasi_az)/array_sum($defuzzyfikasi_a)
                // 'rata_rata'=>0
            ]
        ];

        return $data;
    }
}
