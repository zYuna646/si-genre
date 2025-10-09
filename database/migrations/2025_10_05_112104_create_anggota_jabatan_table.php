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
        Schema::create('anggota_jabatan', function (Blueprint $table) {
            $table->foreignId('anggota_id')->constrained()->onDelete('cascade');
            $table->foreignId('jabatan_id')->constrained()->onDelete('cascade');
            $table->primary(['anggota_id', 'jabatan_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_jabatan');
    }
};
