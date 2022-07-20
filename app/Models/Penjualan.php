<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $primaryKey  = 'id';
    protected $table = 'penjualan';
    protected $fillable = [
        'tahun',
        'bulan',
        'tanggal',
        'jumlah'
    ];
    public $timestamps = false;


    use HasFactory;
}
