<?php

namespace Tests\Feature;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_teacher_create_form_and_store_teacher(): void
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin.teacher@cakrawala.test',
            'password' => 'secret123',
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        $this->get(route('admin.guru.create'))
            ->assertOk()
            ->assertSee('Tambah Guru Baru');

        $response = $this->post(route('admin.guru.store'), [
            'name' => 'Guru Anyar, S.Pd',
            'email' => 'guru.anyar@cakrawala.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'nip' => '19900101202602',
            'subject' => 'Kimia',
            'phone' => '08123456789',
            'status' => 'active',
        ]);

        $response->assertRedirect(route('admin.guru.index'));
        $this->assertDatabaseHas('users', ['email' => 'guru.anyar@cakrawala.test', 'name' => 'Guru Anyar, S.Pd']);
        $this->assertDatabaseHas('teachers', ['nip' => '19900101202602', 'subject' => 'Kimia']);
    }

    public function test_admin_can_view_teacher_details(): void
    {
        $admin = User::create([
            'name' => 'Admin Teacher Detail Test',
            'email' => 'admin.teacherdetail@cakrawala.test',
            'password' => 'secret123',
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        $user = User::create([
            'name' => 'Siti Guru',
            'email' => 'siti@example.test',
            'password' => 'password123',
            'role' => 'teacher',
        ]);
        $teacher = $user->teacher()->create([
            'nip' => '19850101202603',
            'subject' => 'Biologi',
            'phone' => '081299998888',
            'status' => 'active',
        ]);

        $this->get(route('admin.guru.show', $teacher))
            ->assertOk()
            ->assertSee('Siti Guru')
            ->assertSee('Biologi')
            ->assertSee('19850101202603');
    }

    public function test_admin_can_update_and_delete_teacher_with_related_user(): void
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin.teacher@cakrawala.test',
            'password' => 'secret123',
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        $user = User::create([
            'name' => 'Budi Guru',
            'email' => 'budi@example.test',
            'password' => 'password123',
            'role' => 'teacher',
        ]);
        $teacher = $user->teacher()->create([
            'nip' => '19800101202601',
            'subject' => 'Matematika',
            'status' => 'active',
        ]);

        $response = $this->put(route('admin.guru.update', $teacher), [
            'name' => 'Budi Guru Updated',
            'email' => 'budi.updated@example.test',
            'password' => '',
            'password_confirmation' => '',
            'nip' => '19800101202601',
            'subject' => 'Fisika',
            'status' => 'inactive',
        ]);

        $response->assertRedirect(route('admin.guru.index'));
        $this->assertDatabaseHas('teachers', ['id' => $teacher->id, 'subject' => 'Fisika', 'status' => 'inactive']);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Budi Guru Updated']);

        $this->delete(route('admin.guru.destroy', $teacher))->assertRedirect(route('admin.guru.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('teachers', ['id' => $teacher->id]);
    }

    public function test_admin_can_filter_and_manage_students(): void
    {
        $admin = User::create([
            'name' => 'Admin Student Test',
            'email' => 'admin.student@cakrawala.test',
            'password' => 'secret123',
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        $userActive = User::create([
            'name' => 'Ahmad Siswa',
            'email' => 'ahmad@example.test',
            'password' => 'password123',
            'role' => 'student',
        ]);
        $studentActive = $userActive->student()->create([
            'nisn' => '1122334455',
            'class_name' => 'XII IPA 1',
            'status' => 'active',
        ]);

        $userInactive = User::create([
            'name' => 'Bambang Siswa',
            'email' => 'bambang@example.test',
            'password' => 'password123',
            'role' => 'student',
        ]);
        $studentInactive = $userInactive->student()->create([
            'nisn' => '9988776655',
            'class_name' => 'XI IPS 2',
            'status' => 'inactive',
        ]);

        // Search test
        $response = $this->get(route('admin.siswa.index', ['search' => 'Ahmad']));
        $response->assertOk()
            ->assertSee('Ahmad Siswa')
            ->assertDontSee('Bambang Siswa');

        // Status filter test
        $responseInactive = $this->get(route('admin.siswa.index', ['status' => 'inactive']));
        $responseInactive->assertOk()
            ->assertSee('Bambang Siswa')
            ->assertDontSee('Ahmad Siswa');

        // Delete test
        $this->delete(route('admin.siswa.destroy', $studentActive))->assertRedirect(route('admin.siswa.index'));
        $this->assertDatabaseMissing('students', ['id' => $studentActive->id]);
        $this->assertDatabaseMissing('users', ['id' => $userActive->id]);
    }

    public function test_admin_can_filter_and_search_payments(): void
    {
        $admin = User::create([
            'name' => 'Admin Payment Test',
            'email' => 'admin.payment@cakrawala.test',
            'password' => 'secret123',
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        $user = User::create([
            'name' => 'Citra Siswa',
            'email' => 'citra@example.test',
            'password' => 'password123',
            'role' => 'student',
        ]);
        $student = $user->student()->create([
            'nisn' => '1234567890',
            'class_name' => 'X IPA 1',
            'status' => 'active',
        ]);

        $paymentPending = $student->payments()->create([
            'invoice_number' => 'INV-001',
            'amount' => 500000,
            'description' => 'SPP Bulan Juli',
            'status' => 'pending',
        ]);

        $paymentConfirmed = $student->payments()->create([
            'invoice_number' => 'INV-002',
            'amount' => 750000,
            'description' => 'Uang Ujian Semester',
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);

        // Filter pending
        $this->get(route('admin.pembayaran', ['status' => 'pending']))
            ->assertOk()
            ->assertSee('INV-001')
            ->assertDontSee('INV-002');

        // Search invoice
        $this->get(route('admin.pembayaran', ['search' => 'INV-002']))
            ->assertOk()
            ->assertSee('INV-002')
            ->assertDontSee('INV-001');
    }

    public function test_admin_can_create_and_update_student_with_email_and_password(): void
    {
        $admin = User::create([
            'name' => 'Admin Student Form Test',
            'email' => 'admin.studentform@cakrawala.test',
            'password' => 'secret123',
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        $teacherUser = User::create([
            'name' => 'Guru Wali',
            'email' => 'guru.wali@cakrawala.test',
            'password' => 'password123',
            'role' => 'teacher',
        ]);
        $teacher = $teacherUser->teacher()->create([
            'nip' => '19900101202609',
            'subject' => 'Fisika',
            'status' => 'active',
        ]);
        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Fisika XI IPA',
            'subject' => 'Fisika',
            'grade_level' => 'XI',
        ]);

        $response = $this->post(route('admin.siswa.store'), [
            'name' => 'Siswa Baru Admin',
            'nisn' => '1020304050',
            'email' => 'siswa.baru@cakrawala.test',
            'password' => 'password123',
            'school_name' => 'SMA Cakrawala 1',
            'address' => 'Jl. Pendidikan No. 12',
            'classroom_id' => $classroom->id,
            'guardian_name' => 'Bapak Siswa',
            'phone' => '081234567890',
            'status' => 'active',
        ]);

        $response->assertRedirect(route('admin.siswa.index'));
        $this->assertDatabaseHas('users', ['name' => 'Siswa Baru Admin', 'email' => 'siswa.baru@cakrawala.test']);
        $this->assertDatabaseHas('students', ['nisn' => '1020304050', 'school_name' => 'SMA Cakrawala 1']);

        $student = Student::where('nisn', '1020304050')->firstOrFail();

        $updateResponse = $this->put(route('admin.siswa.update', $student), [
            'name' => 'Siswa Baru Updated',
            'nisn' => '1020304050',
            'email' => 'siswa.updated@cakrawala.test',
            'password' => 'newpassword123',
            'school_name' => 'SMA Cakrawala Updated',
            'address' => 'Jl. Pendidikan No. 99',
            'classroom_id' => $classroom->id,
            'guardian_name' => 'Ibu Siswa',
            'phone' => '081299990000',
            'status' => 'active',
        ]);

        $updateResponse->assertRedirect(route('admin.siswa.index'));
        $this->assertDatabaseHas('users', ['id' => $student->user_id, 'name' => 'Siswa Baru Updated', 'email' => 'siswa.updated@cakrawala.test']);
    }
}
