<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKendaraan extends Model
{
    protected $fillable = ['jenis_kendaraan','daerah','harga'];

    public function kamadjayas() {
      return $this->hasMany(Kamadjaya::class);
    }
}
