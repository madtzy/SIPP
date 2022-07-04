<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Http\Request;

class AdminProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.produks.index', [
            'produks' => Produk::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.produks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'          => 'required|max:255|unique:produks',
            'harga'         => 'required',
            'stok'          => 'required',
            'keterangan'    => 'required|max:255'
        ]);
        Produk::create($validatedData);
        return redirect('/admin/produks')->with('success', 'Data Produk Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('admin.produks.edit', [
            'produk' => $produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $rules = [
            'harga'         => 'required',
            'stok'          => 'required',
            'keterangan'    => 'required|max:255'
        ];
        //cek apakah ada nama baru?
        if ($request->nama != $produk->nama) {
            $rules['nama'] = 'required|max:255|unique:produks';
        }
        $validatedData = $request->validate($rules);

        Produk::where('id', $produk->id)
            ->update($validatedData);

        return redirect('/admin/produks')->with('success', 'Data Produk Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        Produk::destroy($produk->id);

        return redirect('/admin/produks')->with('success', 'Data Produk Berhasil Dihapus');
    }
}
