<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('storings', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('kendaraan')->unsigned();
          $table->date('tanggal')->nullable();
          $table->string('jenis',50)->nullable();
          $table->double('biaya')->nullable();
          $table->double('biaya_mekanik')->nullable();
          $table->string('mekanik',50)->nullable();
          $table->string('foto',50)->nullable();
          $table->string('foto_bon',50)->nullable();
          $table->timestamps();
      });

      Schema::table('storings', function (Blueprint $table) {
          $table->foreign('kendaraan')
          ->references('id')->on('kendaraans')
          ->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storings');
    }
}
