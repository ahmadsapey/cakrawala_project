<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_and_delete_teacher_with_related_user(): void
    {
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
}
