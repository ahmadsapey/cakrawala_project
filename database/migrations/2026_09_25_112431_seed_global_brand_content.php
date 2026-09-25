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
            'type' => 'brand',
            'title' => 'CAKRAWALA EDUCENTRE',
            'description' => 'Cakrawala Educentre',
            'image_url' => asset('images/logoCakrawala.png'),
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
        DB::table('landing_contents')->where('type', 'brand')->delete();
    }
};
