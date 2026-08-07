<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthBypassTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_without_password_route_does_not_exist(): void
    {
        User::factory()->superUser()->create([
            'email_verified_at' => now(),
        ]);

        $this->get('/login-without-password')
            ->assertNotFound();

        $this->assertGuest();
    }

    public function test_verified_staff_user_can_access_dashboard_with_normal_authentication(): void
    {
        $user = User::factory()->staff()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk();
    }
}
