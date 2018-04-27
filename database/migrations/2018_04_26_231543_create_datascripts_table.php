<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatascriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datascripts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipe')->unsigned();
            $table->integer('no_truck')->unsigned();
            $table->string('no_do',50)->nullable();
            $table->string('barang',50)->nullable();
            $table->string('customer',50)->nullable();
            $table->string('daerah',50)->nullable();
            $table->string('lain',50)->nullable();
            $table->string('cost',50)->nullable();
            $table->timestamps();
        });

        Schema::table('datascripts', function (Blueprint $table) {
            $table->foreign('no_truck')
            ->references('id')->on('kendaraans')
            ->onDelete('cascade');
            $table->foreign('tipe')
            ->references('id')->on('jenis_kendaraans')
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
        Schema::dropIfExists('datascripts');
    }
}
