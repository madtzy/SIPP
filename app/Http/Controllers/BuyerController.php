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
            // 'produks' => Produk::all()
        ]);
    }
    public function store(Request $request)
    {
        $nama = $request('nama');
        $alamat = $request('alamat');
        $tanggal = $request('tanggal');
        $produk = $request('nama_');
        $nama = $request('nama');
        $nama = $request('nama');
        $nama = $request('nama');
        $data = array(
            'nama' => $nama,

        );
        $validatedData = $request->validate([
            'produk_id'     => 'required',
            'nama_produk'   => 'required',
            'nama'          => 'required|max:255',
            'alamat'        => 'required|max:255',
            'nomor_telp'    => 'required',
            'tanggal'       => 'required',
            'jumlah'        => 'required',
            'total_bayar'   => 'required'
        ]);
        
        Buyer::create($validatedData);
        return redirect('https://wa.me/6282140979507?text=Nama%20%3A%20$request("nama")%0Alamat%20%3A%20$alamat%0AJumlah%20%3A%20$jumlah%0ATotal%20Bayar%20%3A%20$total_bayar');
    }
}
