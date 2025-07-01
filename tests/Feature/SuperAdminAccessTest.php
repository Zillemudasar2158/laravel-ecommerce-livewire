<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_be_created_with_all_permissions()
    {
        // Create permissions
        $permission1 = Permission::create(['name' => 'manage users']);
        $permission2 = Permission::create(['name' => 'manage products']);
        $permission3 = Permission::create(['name' => 'manage orders']);

        // Create role and assign permissions
        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo([$permission1, $permission2, $permission3]);

        // Create user and assign role
        $user = User::factory()->create();
        $user->assignRole('Super Admin');

        // Assert role and permissions
        $this->assertTrue($user->hasRole('Super Admin'));
        $this->assertTrue($user->can('manage users'));
        $this->assertTrue($user->can('manage products'));
        $this->assertTrue($user->can('manage orders'));
    }
}
