<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsAndSchedulesTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('subjects')) {
            Schema::create('subjects', function (Blueprint $table): void {
                $table->id();
                $table->string('name')->unique();
                $table->string('code', 20)->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasColumn('classrooms', 'subject_id')) {
            Schema::table('classrooms', function (Blueprint $table): void {
                $table->foreignId('subject_id')->nullable()->after('teacher_id')->constrained('subjects')->nullOnDelete();
            });
        }

        if (! Schema::hasColumn('classrooms', 'online_meeting_url')) {
            Schema::table('classrooms', function (Blueprint $table): void {
                $table->string('online_meeting_url')->nullable()->after('description');
            });
        }

        if (! Schema::hasTable('schedules')) {
            Schema::create('schedules', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
                $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
                $table->foreignId('subject_id')->nullable()->constrained()->nullOnDelete();
                $table->string('day_of_week', 20);
                $table->string('start_time', 10);
                $table->string('end_time', 10);
                $table->string('online_meeting_url')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('teacher_attendances')) {
            Schema::create('teacher_attendances', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
                $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
                $table->date('attendance_date');
                $table->timestamp('session_started_at')->nullable();
                $table->string('status', 20)->default('hadir');
                $table->timestamps();

                $table->unique(['teacher_id', 'classroom_id', 'attendance_date'], 't_attend_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_attendances');
        Schema::dropIfExists('schedules');

        if (Schema::hasColumn('classrooms', 'subject_id')) {
            Schema::table('classrooms', function (Blueprint $table): void {
                $table->dropForeign(['subject_id']);
                $table->dropColumn(['subject_id']);
            });
        }

        if (Schema::hasColumn('classrooms', 'online_meeting_url')) {
            Schema::table('classrooms', function (Blueprint $table): void {
                $table->dropColumn(['online_meeting_url']);
            });
        }

        Schema::dropIfExists('subjects');
    }
}
