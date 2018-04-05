<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatakendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nopol',50)->nullable();
            $table->string('stnk',50)->nullable();
            $table->string('tahun',11)->nullable();
            $table->string('merk',20)->nullable();
            $table->string('daerah',50)->nullable();
            $table->string('foto',100)->nullable();
            $table->string('kir',50)->nullable();
            $table->string('sipa',50)->nullable();
            $table->string('ibm',50)->nullable();
            $table->string('kiu',50)->nullable();
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
        Schema::dropIfExists('kendaraans');
    }
}
