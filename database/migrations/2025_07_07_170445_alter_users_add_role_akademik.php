<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
            DB::statement("ALTER TABLE panitia MODIFY jabatan_panitia ENUM('ketua', 'sekretaris', 'bendahara', 'panitia', 'akademik') DEFAULT 'panitia'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE panitia MODIFY jabatan_panitia ENUM('ketua', 'sekretaris', 'bendahara', 'panitia') DEFAULT 'panitia'");
    }
};
