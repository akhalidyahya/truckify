<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storing extends Model
{
    protected $fillable = ['kendaraan','tanggal','jenis','biaya','biaya_mekanik','mekanik','foto','foto_bon'];

    public function kendaraans() {
      return $this->belongsTo(Kendaraan::class);
    }
}
