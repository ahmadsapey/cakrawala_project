<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('landing_contents', function (Blueprint $table) {
            $table->id();
            $table->string('type')->index();
            $table->string('badge')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->string('meta')->nullable();
            $table->string('price')->nullable();
            $table->string('price_suffix')->nullable();
            $table->json('features')->nullable();
            $table->string('cta_label')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        DB::table('landing_contents')->insert([
            ['type' => 'program', 'badge' => 'INTERAKTIF', 'title' => 'Kelas Menuju Perguruan Tinggi', 'description' => 'Program belajar terarah untuk mempersiapkan langkah menuju kampus impian.', 'image_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80', 'meta' => '4.9 | 12 Sesi Materi', 'price' => 'Rp 75K', 'price_suffix' => '/bln', 'features' => json_encode(['Materi terstruktur', 'Pendampingan tutor']), 'cta_label' => 'Lihat program', 'is_featured' => false, 'is_active' => true, 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['type' => 'program', 'badge' => 'WEBINAR', 'title' => 'Strategi Sosialisasi Calon Mahasiswa', 'description' => 'Sesi live untuk membantu siswa memahami pilihan jurusan dan jalur masuk perguruan tinggi.', 'image_url' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=600&q=80', 'meta' => '4.8 | Live Session', 'price' => 'Gratis', 'price_suffix' => ' Member', 'features' => json_encode(['Live session', 'Rekaman tersedia']), 'cta_label' => 'Ikuti webinar', 'is_featured' => false, 'is_active' => true, 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['type' => 'program', 'badge' => 'TRYOUT NASIONAL', 'title' => 'Simulasi Ujian SNBP & SNBT Akurat', 'description' => 'Latihan ujian dengan analisis hasil untuk memetakan kesiapan akademik siswa.', 'image_url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=600&q=80', 'meta' => '5.0 | Sistem IRT', 'price' => 'Mulai Rp 25K', 'price_suffix' => '', 'features' => json_encode(['Sistem IRT', 'Analisis hasil']), 'cta_label' => 'Mulai tryout', 'is_featured' => false, 'is_active' => true, 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['type' => 'program', 'badge' => 'KONSULTASI', 'title' => 'Bedah Kampus & Jurusan Impian', 'description' => 'Konsultasi personal untuk menyusun strategi pilihan kampus dan jurusan.', 'image_url' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=600&q=80', 'meta' => '4.9 | 1 on 1 Mentor', 'price' => 'Mulai Rp 50K', 'price_suffix' => '', 'features' => json_encode(['Mentor berpengalaman', 'Sesi personal']), 'cta_label' => 'Konsultasi', 'is_featured' => false, 'is_active' => true, 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['type' => 'package', 'badge' => 'PAKET BELAJAR', 'title' => 'Paket Belajar', 'description' => 'Akses materi lengkap dan berkualitas untuk memperdalam konsep dasar.', 'image_url' => null, 'meta' => 'Materi sesuai kurikulum', 'price' => 'Rp 149.000', 'price_suffix' => '/bln', 'features' => json_encode(['Materi sesuai kurikulum', 'E-learning 24/7 jam']), 'cta_label' => 'Pilih paket', 'is_featured' => false, 'is_active' => true, 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['type' => 'package', 'badge' => 'FAVORIT', 'title' => 'Bimbingan Intensif', 'description' => 'Pendampingan langsung tutor profesional untuk tembus PTN.', 'image_url' => null, 'meta' => 'Live class interaktif', 'price' => 'Rp 75.000', 'price_suffix' => '/sesi', 'features' => json_encode(['Live class interaktif', 'Tanya jawab grup privat']), 'cta_label' => 'Ikuti bimbingan', 'is_featured' => true, 'is_active' => true, 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['type' => 'package', 'badge' => 'ANALISIS', 'title' => 'Rasionalisasi SNBP', 'description' => 'Analisis strategi prodi akurat berdasarkan nilai rapor dan data.', 'image_url' => null, 'meta' => 'Rekomendasi prodi tepat', 'price' => 'Rp 15.000', 'price_suffix' => '/karya', 'features' => json_encode(['Rekomendasi prodi tepat', 'Validasi data rapor online']), 'cta_label' => 'Analisis rapor', 'is_featured' => false, 'is_active' => true, 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['type' => 'package', 'badge' => 'TRYOUT', 'title' => 'Tryout Nasional', 'description' => 'Simulasi ujian berkala nasional dengan sistem penilaian IRT.', 'image_url' => null, 'meta' => 'Peringkat nasional', 'price' => 'Rp 25.000', 'price_suffix' => '/sesi', 'features' => json_encode(['Sistem penilaian mirip UTBK', 'Peringkat nasional & analisis']), 'cta_label' => 'Daftar tryout', 'is_featured' => false, 'is_active' => true, 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['type' => 'package', 'badge' => 'PRIVAT', 'title' => 'Konsultasi Privat', 'description' => 'Sesi diskusi khusus personal dengan mentor ahli untuk bedah masalah.', 'image_url' => null, 'meta' => '1 on 1 via video call', 'price' => 'Rp 99.000', 'price_suffix' => '/jam', 'features' => json_encode(['1 on 1 via video call', 'Solusi bedah soal mendalam']), 'cta_label' => 'Book jadwal', 'is_featured' => false, 'is_active' => true, 'sort_order' => 5, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_contents');
    }
};
