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
            Schema::table('panitia', function (Blueprint $table) {
                $table->string('email')->unique()->after('nama_panitia');
                $table->string('password')->after('email');
            });

            Schema::table('peserta', function (Blueprint $table) {
                $table->string('password')->after('nama');
            });
     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('panitia', function (Blueprint $table) {
            $table->dropColumn(['email', 'password']);
        });

        Schema::table('peserta', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
};
