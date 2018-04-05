<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['no','nominal','tgl_invoice','tgl_tempo','tgl_do','tgl_bayar','logistik'];
}
