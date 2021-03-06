<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamadjaya extends Model
{
    protected $fillable = ['tanggal', 'no_truck', 'no_do', 'tipe', 'customer', 'destinasi', 'wilayah', 'daerah', 'qty', 'total_do', 'desc', 'cost'];

    public function kendaraans() {
      return $this->belongsTo(Kendaraan::class);
    }

    public function JenisKendaraans() {
      return $this->belongsTo(JenisKendaraan::class);
    }
}
