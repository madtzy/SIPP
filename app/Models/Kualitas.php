<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kualitas extends Model
{
    protected $primaryKey  = 'id';
    protected $table = 'kualitas';
    protected $fillable = [
        'tahun',
        'bulan',
        'tanggal',
        'jumlah'
    ];
    public $timestamps = false;


    use HasFactory;
}
