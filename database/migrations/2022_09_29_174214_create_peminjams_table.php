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
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('email_peminjam');
            $table->string('level');
            $table->string('dosen_pembimbing')->nullable();
            $table->string('nip_dosen')->nullable();
            $table->string('keperluan');
            $table->string('nim');
            $table->string('fakultas');
            $table->string('jurusan');
            $table->string('kontak');
            $table->string('kode_peminjaman')->unique();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->string('file_name');
            $table->string('surat_izin')->nullable();
            $table->text('barang');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('peminjams');
    }
};
