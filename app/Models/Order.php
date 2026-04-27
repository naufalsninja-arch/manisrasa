<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $fillable = [
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