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
        Schema::table('materials', function (Blueprint $table) {
            if (! Schema::hasColumn('materials', 'teacher_id')) {
                $table->foreignId('teacher_id')->nullable()->constrained()->nullOnDelete();
            }
            if (! Schema::hasColumn('materials', 'subject')) {
                $table->string('subject')->nullable();
            }
            if (! Schema::hasColumn('materials', 'title')) {
                $table->string('title')->nullable();
            }
            if (! Schema::hasColumn('materials', 'summary')) {
                $table->text('summary')->nullable();
            }
            if (! Schema::hasColumn('materials', 'video_url')) {
                $table->string('video_url')->nullable();
            }
            if (! Schema::hasColumn('materials', 'status')) {
                $table->string('status')->default('draft')->index();
            }
            if (! Schema::hasColumn('materials', 'published_at')) {
                $table->timestamp('published_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['teacher_id', 'subject', 'title', 'summary', 'video_url', 'status', 'published_at']);
        });
    }
};
