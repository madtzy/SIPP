<?php

namespace App\Http\Controllers;

use App\Models\Beras;
use Illuminate\Http\Request;

class BerasController extends Controller
{
    public function index()
    {
        return view('user.beras', [
            'title' => 'All Produk',
            'beras' => Beras::latest()->filter(request(['search']))->paginate(12)->withQueryString()
        ]);
    }
}
