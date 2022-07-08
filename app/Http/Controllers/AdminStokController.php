<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Http\Request;

class AdminStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.stoks.index', [
            'title' => 'All Stok',
            'stoks' => Stok::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.stoks.create', [
        //     'title' => 'Form Tambah Stok',
        //     'produks' => Produk::all()
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'produk_id' => 'required',
        //     'tanggal' => 'required',
        //     'stok_sebelumnya' => 'required',
        //     'stok_tambah' => 'required',
        //     'stok_akhir' => 'required',
        //     'kualitas' => 'required'
        // ]);

        // Stok::create($validatedData);

        // return redirect('/admin/stoks')->with('success', 'Data Stok Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function show(Stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function edit(Stok $stok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stok $stok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stok $stok)
    {
        //
    }
}
