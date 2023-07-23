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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nis',40);
            $table->string('nama',60);
            $table->string('no_hp',32);
            $table->string('email',32);
            $table->string('nama_ayah', 60)->nullable();
            $table->string('nama_ibu',60)->nullable();
            $table->string('jenis_kelas',32);
            $table->string('tempat_lahir',60)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('avatar',60)->nullable();
            
            $table->timestamps();

             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
};
