<?php

namespace App\Http\Controllers;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Buyer;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::sum('jumlah');
        $stok = Produk::sum('stok');
        $penghasilan = Buyer::where('status','terima')->sum('total_bayar');
        $diterima = Buyer::where('status','terima')->count();
        $ditolak = Buyer::where('status','tolak')->count();
        $diproses = Buyer::where('status','proses')->count();

        return view('admin.dashboard',[
            'title' => 'Dashboard',
            'penjualan' => $penjualan,
            'stok' => $stok,
            'penghasilan' => number_format($penghasilan,2,',','.'),
            'diterima' => $diterima,
            'ditolak' => $ditolak,
            'diproses' => $diproses
        ]);
    }
}
