<?php

namespace App\Http\Controllers;


use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('user.produks', [
            'title' => 'All Produk',
            'produks' => Produk::latest()->filter(request(['search']))->paginate(12)->withQueryString()
        ]);
    }
}
