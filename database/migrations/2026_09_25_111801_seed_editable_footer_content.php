<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $now = now();

        DB::table('landing_contents')->insert([
            'type' => 'footer',
            'title' => 'Cakrawala PT. INDO PRESTASI UTAMA',
            'description' => 'Pusat layanan konsultasi belajar, tryout online, dan pendampingan akademik terpercaya di Indonesia dengan standar mutu terbaik.',
            'meta' => 'info@cakrawala.id',
            'cta_label' => '+62 812-3456-7890',
            'is_active' => true,
            'sort_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('landing_contents')->where('type', 'footer')->delete();
    }
};
