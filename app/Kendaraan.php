<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = ['nopol','stnk','tahun','merk','daerah','foto','kir','sipa','ibm','kiu'];

    public function storings() {
      return $this->hasMany(Storing::class);
    }

    public function kamadjayas() {
      return $this->hasMany(Kamadjaya::class);
    }
}
