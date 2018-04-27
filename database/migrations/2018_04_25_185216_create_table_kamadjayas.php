<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKamadjayas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamadjayas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal')->nullable();
            $table->integer('no_truck')->unsigned();
            $table->string('no_do',50)->nullable();
            $table->integer('tipe')->unsigned();
            $table->string('customer',50)->nullable();
            $table->string('destinasi',100)->nullable();
            $table->string('wilayah',20)->nullable();
            $table->string('daerah',20)->nullable();
            $table->string('qty')->nullable();
            $table->string('total_do',20)->nullable();
            $table->string('desc',500)->nullable();
            $table->string('cost',20)->nullable();
            $table->timestamps();
        });

        Schema::table('kamadjayas', function (Blueprint $table) {
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
        Schema::dropIfExists('kamadjayas');
    }
}
