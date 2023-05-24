<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    
    protected $table = 'tb_penjualan';
    protected $primaryKey = 'id_penjualan';
    public $timestamps = false; // Jika tidak menggunakan kolom created_at dan updated_at
    
    protected $fillable = [
        'no_transaksi',
        'total_transaksi',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];
}
