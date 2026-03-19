<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Setup an authenticated admin
        $this->admin = Admin::create([
            'name' => 'Root Admin',
            'email' => 'root@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    public function test_admin_can_view_users_list(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertSee('Admin Users');
        $response->assertSee('root@example.com');
    }

    public function test_admin_can_view_create_user_form(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.users.create'));

        $response->assertStatus(200);
        $response->assertSee('Add Administrator');
    }

    public function test_admin_can_create_new_admin_user(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->post(route('admin.users.store'), [
            'name' => 'New Admin',
            'email' => 'newadmin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('admins', [
            'email' => 'newadmin@example.com',
            'name' => 'New Admin'
        ]);
    }

    public function test_admin_can_update_another_admin_user(): void
    {
        $otherAdmin = Admin::create([
            'name' => 'Other Admin',
            'email' => 'other@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($this->admin, 'admin')->put(route('admin.users.update', $otherAdmin), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('admins', [
            'id' => $otherAdmin->id,
            'email' => 'updated@example.com',
            'name' => 'Updated Name'
        ]);
    }

    public function test_admin_can_delete_another_admin_user(): void
    {
        $otherAdmin = Admin::create([
            'name' => 'Other Admin',
            'email' => 'other@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($this->admin, 'admin')->delete(route('admin.users.destroy', $otherAdmin));

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('admins', [
            'id' => $otherAdmin->id,
        ]);
    }

    public function test_admin_cannot_delete_themselves(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->delete(route('admin.users.destroy', $this->admin));

        $response->assertRedirect(); // Back with errors
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('admins', [
            'id' => $this->admin->id,
        ]);
    }
}
