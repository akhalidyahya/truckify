<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $fillable = ['storing','ujskamadjaya','ujsdatascript','ujssogood','tanggal','lain','keterangan','pemasukan','total'];
}
