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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id('id_proposal');
            $table->string('nama_acara');
            $table->string('jenis_acara');
            $table->string('nama_pengusul');
            $table->string('judul_proposal');
            $table->string('file_proposal');
            $table->date('tanggal_pengajuan');
            $table->enum('status_proposal', ['Diajukan', 'Disetujui', 'Ditolak']);
            $table->integer('estimasi_peserta');
            $table->text('kebutuhan_logistik');
            $table->date('tanggal_acara');
            $table->time('waktu_acara');
            $table->text('detail_acara');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
