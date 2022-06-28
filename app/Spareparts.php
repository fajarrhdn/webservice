<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spareparts extends Model
{
    protected $fillable = [
        'nama_sparepart', 'minimal_stok', 'stok'
    ];
}
