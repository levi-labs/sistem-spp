<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout', function (Blueprint $table) {
            $table->id();
            $table->string('invoice',60);
            $table->bigInteger('id_transaksi')->unsigned();
            $table->bigInteger('siswa_id')->unsigned();
            $table->string('tanggal',40);
            $table->string('status',32)->default('UNPAID');
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')->on('transaksi')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout');
    }
};
