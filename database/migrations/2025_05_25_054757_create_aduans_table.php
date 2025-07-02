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
        Schema::create('aduans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug');
            $table->text('isi');
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('nomor_wa');
            $table->string('nomor_tiket')->unique();
            $table->string('lokasi');    
            $table->text('lampiran')->nullable();
            $table->boolean('is_visible')->default(false);
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai'])->default('Menunggu');
            $table->foreignId('opd_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aduans');
    }
};
