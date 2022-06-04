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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nopol');
            $table->string('nama_kendaraan')->nullable();
            $table->string('nama_pemesan');
            $table->string('keterangan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_stop');
            $table->enum('status',['Proses','Diterima','Ditolak'])->default('Proses');
            $table->string('nama_driver');
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
        Schema::dropIfExists('pesanans');
    }
};
