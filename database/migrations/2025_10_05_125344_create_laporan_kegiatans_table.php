<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
            $table->integer('jumlah_peserta')->default(0);
            $table->text('daftar_hadir')->nullable(); // Path ke file daftar hadir
            $table->text('dokumentasi_foto')->nullable(); // Path ke foto kegiatan
            $table->text('dokumentasi_video')->nullable(); // Path ke video kegiatan
            $table->text('ringkasan_kegiatan')->nullable();
            $table->text('surat_undangan')->nullable(); // Path ke file surat undangan
            $table->text('notulen_rapat')->nullable(); // Path ke file notulen
            $table->text('brosur_poster')->nullable(); // Path ke file brosur/poster
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kegiatans');
    }
};
