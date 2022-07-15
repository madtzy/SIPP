<?php

namespace App\Http\Controllers;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Buyer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminDashboardController extends Controller
{
    public function index(Request $req )
    {
        $tahun = date('Y');
        if($req->tahun) $tahun = $req->tahun;


        $penjualan = Penjualan::sum('jumlah');
        $stok = Produk::sum('stok');
        $penghasilan = Buyer::where('status','terima')->sum('total_bayar');
        $diterima = Buyer::where('status','terima')->count();
        $ditolak = Buyer::where('status','tolak')->count();
        $diproses = Buyer::where('status','proses')->count();

        $penjualan = ($penjualan!=null)? $penjualan : 0;
        $stok = ($stok!=null)? $stok : 0;
        $penghasilan = ($penghasilan!=null)? $penghasilan : 0;
        $diterima = ($diterima!=null)? $diterima : 0;
        $ditolak = ($ditolak!=null)? $ditolak : 0;
        $diproses = ($diproses!=null)? $diproses : 0;

        $data = DB::select("select * from bulanan where tahun = '".$tahun."'");
        $hasilPenjualan = [];
        $hasilPersediaan = [];
        if($data){
            foreach($data as $i => $rec){
                $hasilPenjualan[$rec->bulan] = $rec->penjualan;
                $hasilPersediaan[$rec->bulan] = $rec->persediaan;
            }
        }


        $dataPenjualan = [];
        $dataPersediaan = [];
        for ($i=0; $i < 12 ; $i++) {
            $dataPenjualan[] = (!empty($hasilPenjualan[$i]))? $hasilPenjualan[$i] : 0;
            $dataPersediaan[] = (!empty($hasilPersediaan[$i]))? $hasilPersediaan[$i] : 0;
        }

        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 150])
        ->labels(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus','Oktober','November','Desember'])
        ->datasets([
            [
                "label" => "Persediaan",
                'backgroundColor' => "rgba(255, 99, 132, 0.31)",
                'borderColor' => "rgba(255, 99, 132, 0.7)",
                "pointBorderColor" => "rgba(255, 99, 132, 0.7)",
                "pointBackgroundColor" => "rgba(255, 99, 132, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $dataPersediaan,
            ],
            [
                "label" => "Penjualan",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $dataPenjualan,
            ]
        ])
        ->options([]);



        return view('admin.dashboard',[
            'title' => 'Dashboard',
            'penjualan' => $penjualan,
            'stok' => $stok,
            'penghasilan' => number_format($penghasilan,2,',','.'),
            'diterima' => $diterima,
            'ditolak' => $ditolak,
            'diproses' => $diproses,
            'tahun' => $tahun,
            'chartjs'=>$chartjs
        ]);
    }
}
