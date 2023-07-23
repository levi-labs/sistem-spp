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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('siswa_id')->unsigned();
            $table->string('id_transaksi');
            $table->string('jenis_biaya',42);
            $table->double('jumlah')->nullable();
            $table->string('tanggal');
            $table->string('status',32)->default('UNPAID');
            $table->timestamps();
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            // $table->foreign('id_biaya')->references('id')->on('biayalain')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
