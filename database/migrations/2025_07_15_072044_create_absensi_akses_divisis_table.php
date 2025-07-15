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
        Schema::create('absensi_akses_divisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proposal');
            $table->unsignedBigInteger('id_divisi');
            $table->timestamps();

            $table->foreign('id_proposal')->references('id_proposal')->on('proposals')->onDelete('cascade');
            $table->foreign('id_divisi')->references('id_divisi')->on('divisis')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_akses_divisis');
    }
};
