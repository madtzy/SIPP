<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Stok;
use App\Models\Kualitas;
use App\Models\Persediaan;
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
        $products = Produk::get();
        //
        return view('admin.stoks.create', [
            'title' => 'Create Stok',
            'products'=>$products
        ]);
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
            'produk_id'          => 'required|exists:produks,id',
            'tanggal'         => 'required',
            'kualitas'         => 'required',
            'stok'          => 'required',
        ]);

        $tanggal = $request->tanggal;
        $tahun = (int) date('Y',strtotime($tanggal));
        $bulan = (int) date('m',strtotime($tanggal));
        $hari = (int) date('d',strtotime($tanggal));
        $stok = Stok::create($validatedData);
        if($stok){
            $stok_hariini = Stok::where('tanggal',$tanggal)->sum('stok');
            $kualitas_hariini = Stok::where('tanggal',$tanggal)->avg('kualitas');
            $kualitas = [
                'tahun'=>$tahun,
                'bulan'=>$bulan,
                'tanggal'=>$hari,
                'jumlah'=>$kualitas_hariini,
            ];

            $persediaan = [
                'tahun'=>$tahun,
                'bulan'=>$bulan,
                'tanggal'=>$hari,
                'jumlah'=>$stok_hariini,
            ];

            $cekKualitas = Kualitas::where('tahun',$tahun)->where('bulan',$bulan)->where('tanggal',$tanggal)->first();
            if($cekKualitas){
                Kualitas::where('id',$cekKualitas->id)->update($kualitas);
            }else{
                Kualitas::create($kualitas);
            }

            $cekPersediaan = Persediaan::where('tahun',$tahun)->where('bulan',$bulan)->where('tanggal',$tanggal)->first();
            if($cekPersediaan){
                Persediaan::where('id',$cekPersediaan->id)->update($persediaan);
            }else{
                Persediaan::create($persediaan);
            }

            stokGenerate($request->produk_id);
        }

        return redirect('/admin/stoks')->with('success', 'Data Stok Berhasil Ditambah');
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
        $products = Produk::get();
        return view('admin.stoks.edit', [
            'title' => 'Create Stok',
            'products'=>$products,
            'stok'=>$stok
        ]);
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
        $validatedData = $request->validate([
            'produk_id'          => 'required|exists:produks,id',
            'tanggal'         => 'required',
            'kualitas'         => 'required',
            'stok'          => 'required',
        ]);

        $tanggal = $request->tanggal;
        $tahun = (int) date('Y',strtotime($tanggal));
        $bulan = (int) date('m',strtotime($tanggal));
        $hari = (int) date('d',strtotime($tanggal));

        $stok = Stok::where('id', $stok->id)
            ->update($validatedData);
        if($stok){
            $stok_hariini = Stok::where('tanggal',$tanggal)->sum('stok');
            $kualitas_hariini = Stok::where('tanggal',$tanggal)->avg('kualitas');
            $kualitas = [
                'tahun'=>$tahun,
                'bulan'=>$bulan,
                'tanggal'=>$hari,
                'jumlah'=>$kualitas_hariini,
            ];

            $persediaan = [
                'tahun'=>$tahun,
                'bulan'=>$bulan,
                'tanggal'=>$hari,
                'jumlah'=>$stok_hariini,
            ];

            $cekKualitas = Kualitas::where('tahun',$tahun)->where('bulan',$bulan)->where('tanggal',$tanggal)->first();
            if($cekKualitas){
                Kualitas::where('id',$cekKualitas->id)->update($kualitas);
            }else{
                Kualitas::create($kualitas);
            }

            $cekPersediaan = Persediaan::where('tahun',$tahun)->where('bulan',$bulan)->where('tanggal',$tanggal)->first();
            if($cekPersediaan){
                Persediaan::where('id',$cekPersediaan->id)->update($persediaan);
            }else{
                Persediaan::create($persediaan);
            }
            stokGenerate($request->produk_id);
        }

        return redirect('/admin/stoks')->with('success', 'Data Stok Berhasil Diubah');
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
