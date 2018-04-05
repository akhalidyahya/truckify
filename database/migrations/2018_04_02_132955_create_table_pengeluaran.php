<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pengeluarans', function (Blueprint $table) {
          $table->increments('id');
          $table->date('tanggal')->nullable();
          $table->double('ujskamadjaya')->nullable();
          $table->double('ujsdatascript')->nullable();
          $table->double('ujssogood')->nullable();
          $table->double('storing')->nullable();
          $table->double('lain')->nullable();
          $table->string('keterangan',1500)->nullable();
          $table->double('pemasukan')->nullable();
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
