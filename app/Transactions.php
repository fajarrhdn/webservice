<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = [
        'no_transaksi', 'nama_pemohon', 'id_user'
    ];
}
