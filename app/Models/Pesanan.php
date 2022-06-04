<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nopol',
        'nama_kendaraan',
        'nama_pemesan',
        'keterangan',
        'tanggal_mulai',
        'tanggal_stop',
        'status',
        'nama_driver',
    ];
    protected $dates = [
        'tanggal_mulai',
        'tanggal_stop',
        'created_at',
        'updated_at'
    ];
}
