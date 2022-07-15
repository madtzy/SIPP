<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class AdminBuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.buyers.index', [
            'buyers' => Buyer::latest()->get(),
            'title' => 'Data Pemesan'
        ]);
    }

    public function data($status)
    {
        return view('admin.buyers.index', [
            'buyers' => Buyer::latest()->where('status',$status)->get(),
            'title' => 'Data Pemesan',
            'status' => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        return view('admin.buyers.show', [
            'buyer' => $buyer,
            'title' => 'Detail Pemesan'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyer $buyer)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buyer $buyer)
    {
        $dataBuyer = Buyer::findOrfail($buyer->id);
        $validatedData = [
            'status'=>$request->status
        ];

        $result = Buyer::where('id', $buyer->id)
        ->update($validatedData);
        if($result){
            if($request->status=="terima"){
                $penjualan_hariini = Buyer::where('tanggal',$dataBuyer->tanggal)->where('status','terima')->sum('jumlah');
                $tanggal = $dataBuyer->tanggal;
                $tahun = date('Y',strtotime($tanggal));
                $bulan = date('m',strtotime($tanggal));
                $hari = date('d',strtotime($tanggal));

                $penjualan = [
                    'tahun'=>$tahun,
                    'bulan'=>$bulan,
                    'tanggal'=>$hari,
                    'jumlah'=>$penjualan_hariini,
                ];

                $cekPenjualan = Penjualan::where('tahun',$tahun)->where('bulan',$bulan)->where('tanggal',$hari)->first();
                if($cekPenjualan){
                    Penjualan::where('id',$cekPenjualan->id)->update($penjualan);
                }else{
                    Penjualan::create($penjualan);
                }

                stokGenerate($dataBuyer->produk_id);

            }
        }

        return redirect('/admin/buyers')->with('success', 'Data Pemesanan Berhasil Diverifikasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer)
    {
        //
    }
}
