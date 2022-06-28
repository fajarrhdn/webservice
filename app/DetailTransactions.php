<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransactions extends Model
{
    protected $fillable = [
        'id_transaksi', 'id_sparepart', 'jumlah'
    ];
}
