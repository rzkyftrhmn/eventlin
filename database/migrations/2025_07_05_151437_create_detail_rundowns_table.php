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
        Schema::create('detail_rundowns', function (Blueprint $table) {
            $table->id('id_detail_rundown');
            $table->unsignedBigInteger('id_rundown');
            $table->foreign('id_rundown')->references('id_rundown')->on('rundowns')->onDelete('cascade');
            $table->unsignedBigInteger('id_divisi');
            $table->foreign('id_divisi')->references('id_divisi')->on('divisis')->onDelete('cascade');
            $table->string('judul_rundown');
            $table->time('jam_awal');
            $table->time('jam_akhir');
            $table->text('detail_kegiatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_rundowns');
    }
};
