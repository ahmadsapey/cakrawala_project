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
        $content = static fn (array $attributes): array => array_merge([
            'type' => 'section',
            'badge' => null,
            'title' => '',
            'description' => '',
            'image_url' => null,
            'meta' => null,
            'price' => null,
            'price_suffix' => null,
            'features' => null,
            'cta_label' => null,
            'is_featured' => false,
            'is_active' => true,
            'sort_order' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ], $attributes);

        DB::table('landing_contents')->insert([
            $content(['type' => 'hero', 'badge' => 'Pilihan Belajar Terbaik di Indonesia', 'title' => 'Belajar Lebih Mudah dengan Cakrawala Educentre', 'description' => 'Temukan cara belajar efektif, interaktif, dan fleksibel untuk menguasai berbagai materi pelajaran sesuai impianmu.', 'cta_label' => 'DAFTAR SEKARANG', 'sort_order' => 1]),
            $content(['type' => 'stat', 'title' => '15,000+', 'description' => 'Pengguna aktif', 'sort_order' => 1]),
            $content(['type' => 'stat', 'title' => '1,200+', 'description' => 'Modul belajar', 'sort_order' => 2]),
            $content(['type' => 'stat', 'title' => '4.9/5.0', 'description' => 'Kepuasan user', 'sort_order' => 3]),
            $content(['type' => 'section', 'badge' => 'ONLINE SCHEDULE', 'title' => 'Cakrawala Educentre', 'description' => 'Pilihan tepat untuk mendampingi proses belajar dengan sistem terbaik dan kurikulum mutakhir dari Cakrawala Educentre.', 'meta' => 'PT. INDO PRESTASI UTAMA', 'sort_order' => 1]),
            $content(['type' => 'section', 'badge' => 'PREPARING ANY COURSE', 'title' => 'Mengapa Memilih Cakrawala Educentre?', 'description' => 'Kami berkomitmen memberikan pendidikan berkualitas dengan pendekatan interaktif demi kemajuan belajar terbaik siswa.', 'sort_order' => 2]),
            $content(['type' => 'section', 'badge' => 'DENGAN PILIHAN KAMI', 'title' => 'Nikmati kemudahan akses materi kapan pun dan di mana pun sesuai kebutuhan perkembangan belajar kamu.', 'sort_order' => 3]),
            $content(['type' => 'benefit', 'title' => 'Sistem Komprehensif', 'description' => 'Seluruh komponen belajar dirancang sistematis untuk hasil maksimal.', 'sort_order' => 1]),
            $content(['type' => 'benefit', 'title' => 'Biaya Terjangkau', 'description' => 'Investasi pendidikan terbaik tanpa beban biaya tinggi.', 'sort_order' => 2]),
            $content(['type' => 'benefit', 'title' => 'Program Berfokus', 'description' => 'Spesifik mempersiapkan siswa menghadapi seleksi masuk perguruan tinggi.', 'sort_order' => 3]),
            $content(['type' => 'benefit', 'title' => 'Target Akademik', 'description' => 'Fokus pada peningkatan nilai demi tercapainya target kelulusan.', 'sort_order' => 4]),
            $content(['type' => 'cta', 'title' => 'Siap Naikkan Prestasi Akademikmu di Cakrawala?', 'description' => 'Kombinasi bimbingan, sistem, dan tutor terbaik siap membantumu meraih cita-cita masuk kampus impian lewat Cakrawala Educentre.', 'cta_label' => 'Mulai Konsultasi Sekarang', 'meta' => 'https://wa.me/6281234567890', 'sort_order' => 1]),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('landing_contents')
            ->whereIn('type', ['hero', 'stat', 'section', 'benefit', 'cta'])
            ->delete();
    }
};
