<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_registration_creates_profile_and_can_submit_payment(): void
    {
        $response = $this->post(route('siswa.register.submit'), [
            'name' => 'Siti Pembayar',
            'email' => 'siti.payment@example.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'nisn' => '9876543210',
            'class_name' => 'XII IPA 1',
        ]);

        $response->assertRedirect(route('siswa.payment.create'));
        $student = Student::where('nisn', '9876543210')->firstOrFail();

        $response = $this->post(route('siswa.payment.store'), [
            'amount' => 1500000,
            'description' => 'SPP Semester 1',
        ]);

        $response->assertRedirect(route('siswa.payment.create'));
        $this->assertDatabaseHas('payments', [
            'student_id' => $student->id,
            'status' => 'pending',
            'description' => 'SPP Semester 1',
        ]);
    }

    public function test_admin_can_confirm_pending_payment(): void
    {
        $payment = Payment::factory()->create();

        $response = $this->patch(route('admin.pembayaran.confirm', $payment));

        $response->assertRedirect();
        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'status' => 'confirmed',
        ]);
    }
}
