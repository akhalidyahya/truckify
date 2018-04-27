<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sogood extends Model
{
    protected $fillable = ['tanggal', 'no_truck', 'no_do', 'tipe', 'customer', 'barang', 'lain', 'daerah', 'cost'];

    public function kendaraans() {
      return $this->belongsTo(Kendaraan::class);
    }

    public function JenisKendaraans() {
      return $this->belongsTo(JenisKendaraan::class);
    }
}
