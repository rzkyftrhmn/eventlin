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
        Schema::create('absensi_panitia', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->unsignedBigInteger('id_panitia');
            $table->foreign('id_panitia')->references('id_panitia')->on('panitia')->onDelete('cascade');
            $table->enum('status_kehadiran', ['Hadir', 'Tidak Hadir', 'Izin', 'Terlambat']);
            $table->time('waktu_absen');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_panitia');
    }
};
