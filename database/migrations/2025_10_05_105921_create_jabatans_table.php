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
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->foreignId('jabatan_id')->nullable()->constrained('jabatans')->onDelete('set null');
            $table->foreignId('pikr_id')->constrained('pikrs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatans');
    }
};
