<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Persediaan;
use App\Models\Kualitas;


class LaporanController extends Controller
{
    public function penjualan(Request $request)
    {
        $tahun = $request->get('tahun');
        $penjualan = Penjualan::where('tahun',$tahun)->get();
        $dataPenjualan = [];
        foreach($penjualan as $penj){
            $dataPenjualan[$penj->bulan][$penj->tanggal] = $penj->jumlah;
        }
        return view('admin.laporan.penjualan', [
            'title' => 'Laporan Penjualan',
            'penjualan' => $dataPenjualan,
            'tahun'=>$tahun
        ]);
    }

    public function kualitas(Request $request)
    {
        $tahun = $request->get('tahun');
        $kualitas = Kualitas::where('tahun',$tahun)->get();
        $dataKualitas = [];
        foreach($kualitas as $penj){
            $dataKualitas[$penj->bulan][$penj->tanggal] = $penj->jumlah;
        }
        return view('admin.laporan.kualitas', [
            'title' => 'Laporan Kualitas',
            'kualitas' => $dataKualitas,
            'tahun'=>$tahun
        ]);
    }

    public function persediaan(Request $request)
    {
        $tahun = $request->get('tahun');
        $persediaan = Persediaan::where('tahun',$tahun)->get();
        $dataPersediaan = [];
        foreach($persediaan as $penj){
            $dataPersediaan[$penj->bulan][$penj->tanggal] = $penj->jumlah;
        }
        return view('admin.laporan.persediaan', [
            'title' => 'Laporan Persediaan',
            'persediaan' => $dataPersediaan,
            'tahun'=>$tahun
        ]);
    }
}
