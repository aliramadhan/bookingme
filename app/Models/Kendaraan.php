<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nopol',
        'nama',
        'jenis_kendaraan',
        'jenis_owner',
        'jenis_bbm',
    ];
    public function pesanans()
    {
    	$this->hasMany(Pesanan::class);
    }
}
