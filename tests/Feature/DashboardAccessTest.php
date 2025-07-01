<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_access_dashboard()
    {
        // Create Super Admin role
        $role = Role::create(['name' => 'Super Admin']);

        // Create user & assign role
        $user = User::factory()->create();
        $user->assignRole('Super Admin');

        // Login as Super Admin
        $response = $this->actingAs($user)->get('/productlist');

        $response->assertStatus(200); // ✅ Access allowed
    }

    public function test_normal_user_cannot_access_dashboard()
    {
        $user = User::factory()->create(); // No role

        $response = $this->actingAs($user)->get('/productlist');

        $response->assertStatus(403); // ❌ Forbidden
    }
}
