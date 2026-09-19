<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoFlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin.demo@cakrawala.test'],
            ['name' => 'Admin Demo', 'password' => Hash::make('password123'), 'role' => 'admin'],
        );

        $studentUser = User::updateOrCreate(
            ['email' => 'siswa.demo@cakrawala.test'],
            ['name' => 'Siswa Demo', 'password' => Hash::make('password123'), 'role' => 'student'],
        );
        $student = Student::updateOrCreate(
            ['user_id' => $studentUser->id],
            ['nisn' => '2026000001', 'class_name' => 'XII IPA 1', 'status' => 'active'],
        );

        $teacherUser = User::updateOrCreate(
            ['email' => 'guru.demo@cakrawala.test'],
            ['name' => 'Guru Demo', 'password' => Hash::make('password123'), 'role' => 'teacher'],
        );
        $teacher = Teacher::updateOrCreate(
            ['user_id' => $teacherUser->id],
            ['nip' => '2026000001', 'subject' => 'Fisika', 'status' => 'active'],
        );

        Payment::updateOrCreate(
            ['invoice_number' => 'INV-DEMO-0001'],
            [
                'student_id' => $student->id,
                'amount' => 1500000,
                'description' => 'SPP Semester 1',
                'status' => 'confirmed',
                'confirmed_at' => now(),
            ],
        );

        Material::updateOrCreate(
            ['teacher_id' => $teacher->id, 'title' => 'Gerak Lurus'],
            [
                'subject' => 'Fisika',
                'summary' => 'Konsep dasar gerak lurus dan penerapannya dalam kehidupan sehari-hari.',
                'video_url' => 'https://www.youtube.com/watch?v=demo',
                'status' => 'published',
                'published_at' => now(),
            ],
        );
    }
}
