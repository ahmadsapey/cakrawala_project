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

        DB::table('landing_contents')->updateOrInsert(
            ['type' => 'theme'],
            [
                'title' => 'Pengaturan Warna Landing Page',
                'description' => 'Warna background body, teks, CTA banner, dan footer.',
                'badge' => '#F8FAFC',
                'meta' => '#1E293B',
                'price' => '#0B0F19',
                'price_suffix' => '#FFFFFF',
                'cta_label' => '#080B13',
                'image_url' => '#94A3B8',
                'features' => json_encode([
                    'body_bg' => '#F8FAFC',
                    'body_text' => '#1E293B',
                    'cta_bg' => '#0B0F19',
                    'cta_text' => '#FFFFFF',
                    'footer_bg' => '#080B13',
                    'footer_text' => '#94A3B8',
                ]),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('landing_contents')->where('type', 'theme')->delete();
    }
};
