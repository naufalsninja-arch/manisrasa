<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Tambahkan ini agar Laravel tidak menunggu ID otomatis dari TiDB
    public $incrementing = false; 
    protected $keyType = 'int';

    protected $fillable = [
        'id', // Tambahkan 'id' di sini agar bisa diisi manual
        'nama',
        'whatsapp',
        'produk',
        'varian',
        'jumlah',
        'tanggal',
        'jam',
        'pengiriman',
        'alamat',
        'catatan',
        'status'
    ];
}
