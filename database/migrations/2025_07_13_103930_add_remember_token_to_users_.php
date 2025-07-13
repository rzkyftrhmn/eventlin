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
         Schema::table('pesertas', function (Blueprint $table) {
            $table->rememberToken(); // sama dengan $table->string('remember_token', 100)->nullable();
        });
        Schema::table('panitia', function (Blueprint $table) {
            $table->rememberToken(); // sama dengan $table->string('remember_token', 100)->nullable();
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->rememberToken(); // sama dengan $table->string('remember_token', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('pesertas', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
        Schema::table('panitia', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
    }
};
