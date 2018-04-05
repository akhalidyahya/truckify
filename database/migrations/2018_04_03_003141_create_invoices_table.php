<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no',10)->nullable();
            $table->string('nominal',20)->nullable();
            $table->date('tgl_invoice')->nullable();
            $table->date('tgl_tempo')->nullable();
            $table->date('tgl_do')->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->string('logistik')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
