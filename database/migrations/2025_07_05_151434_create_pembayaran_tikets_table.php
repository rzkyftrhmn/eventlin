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
        Schema::create('pembayaran_tikets', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('pesertas')->onDelete('cascade');
            $table->unsignedBigInteger('id_proposal');
            $table->foreign('id_proposal')->references('id_proposal')->on('proposals')->onDelete('cascade');
            $table->string('bukti_pembayaran'); // Upload bukti transfer
            $table->enum('status_pembayaran', ['Diterima', 'Ditolak', 'Menunggu'])->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_tikets');
    }
};
