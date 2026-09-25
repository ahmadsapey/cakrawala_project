<?php

namespace Tests\Feature;

use App\Models\LandingContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_content_is_rendered_on_the_public_landing_page(): void
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin.landing@cakrawala.test',
            'password' => 'secret123',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.landing.store'), [
            'type' => 'program',
            'badge' => 'PROGRAM BARU',
            'title' => 'Kelas Data Sains',
            'description' => 'Program baru untuk belajar data sains.',
            'image_url' => 'https://example.com/data-sains.jpg',
            'meta' => '4.9 | 8 sesi',
            'price' => 'Rp 100K',
            'price_suffix' => '/bln',
            'features' => "Mentor ahli\nMateri terarah",
            'cta_label' => 'Mulai kelas',
            'is_active' => '1',
            'sort_order' => '10',
        ]);

        $response->assertRedirect(route('admin.landing.index'));
        $content = LandingContent::query()->where('title', 'Kelas Data Sains')->firstOrFail();
        $this->assertSame(['Mentor ahli', 'Materi terarah'], $content->features);
        $this->actingAs($admin)->get(route('admin.landing.index'))
            ->assertOk()
            ->assertSee('Kelola Landing Page')
            ->assertSee('Kelas Data Sains');

        $this->get(route('landing.page'))
            ->assertOk()
            ->assertSee('Kelas Data Sains')
            ->assertSee('Program baru untuk belajar data sains.');
    }

    public function test_inactive_content_is_hidden_from_the_public_landing_page(): void
    {
        $content = LandingContent::create([
            'type' => 'package',
            'badge' => 'RAHASIA',
            'title' => 'Paket Tersembunyi',
            'description' => 'Tidak tampil untuk publik.',
            'is_active' => false,
            'sort_order' => 1,
        ]);

        $this->get(route('landing.page'))
            ->assertOk()
            ->assertDontSee($content->title);
    }
}
