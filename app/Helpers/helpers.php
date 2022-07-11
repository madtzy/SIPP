<?php
use Carbon\Carbon;
use App\Models\Stok;
use App\Models\Produk;
use App\Models\Buyer;

/**
 * Write code on Method
 *
 * @return response()
 */
if (! function_exists('stokGenerate')) {
    function stokGenerate($produk_id)
    {
        $dataStok = Stok::where('produk_id',$produk_id)->sum('stok');
        $dataPenjualan = Buyer::where('produk_id',$produk_id)->where('status','terima')->sum('jumlah');
        $stok = $dataStok-$dataPenjualan;

        Produk::where('id',$produk_id)->update(['stok'=>$stok]);
    }
}

?>
