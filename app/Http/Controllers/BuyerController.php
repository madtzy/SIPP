<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Produk;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        return view('user.form_pembelian',[
            'title' => 'Form Pembelian',
            'produks' => Produk::all()
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'produk_id'     => 'required',
            'nama'          => 'required',
            'alamat'        => 'required|max:255',
            'nomor_telp'    => 'required',
            'tanggal'       => 'required',
            'jumlah'        => 'required',
            'total_bayar'   => 'required'
        ]);
        Buyer::create($validatedData);
        return redirect('https://wa.me/6282140979507?text=Nama%20%3A%20$nama%0Alamat%20%3A%20$alamat%0AJumlah%20%3A%20$jumlah%0ATotal%20Bayar%20%3A%20$total_bayar');
    }
}
