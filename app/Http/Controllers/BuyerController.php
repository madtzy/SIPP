<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index(Produk $produk)
    {
        // ddd($produk);
        return view('user.form_pembelian', [
            'title' => 'Form Pembelian',
            'produk' => $produk
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'produk_id'     => 'required',
            'nama'          => 'required|max:255',
            'alamat'        => 'required|max:255',
            'nomor_telp'    => 'required',
            'tanggal'       => 'required',
            'jumlah'        => 'required|min:1',
            'total_bayar'   => 'required'
        ]);
        $produk = Produk::findOrFail($request->produk_id);

        Buyer::create($validatedData);
        return redirect('https://wa.me/6282140979507?text=Produk%20%3A%20'.$produk->nama.'%20Nama%20%3A%20'.$request->nama.'%20Alamat%20%3A%20'.$request->alamat.'%0AJumlah%20%3A%20'.$request->jumlah.'%0ATotal%20Bayar%20%3A%20'.$request->total_bayar);
    }
}
