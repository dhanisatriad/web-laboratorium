<?php

use App\Models\laboratorium;
use App\Models\lokasi_penyimpanan;
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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorium_id');
            $table->foreignId('lokasi_penyimpanan_id');
            $table->foreignId('peminjam_id')->nullable();
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->string('gambar_barang')->nullable();
            // $table->string('slug')->unique();
            $table->string('kondisi');
            $table->string('status');
            $table->text('deskripsi')->nullable();
            $table->text('part')->nullable();
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
        Schema::dropIfExists('barangs');
    }
};
