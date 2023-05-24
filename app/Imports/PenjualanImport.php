<?php

namespace App\Imports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\ToModel;

class PenjualanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Penjualan([
            //
            'no_transaksi' => $row['no_transaksi'],
            'total_transaksi' => $row['total_transaksi'],
            'tanggal_transaksi' => $row['tanggal_transaksi'],
        ]);
    }
}
