<?php

namespace Tests\Feature\RolesTest;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class SuperAdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCanAddApproverAdmin()
    {
        $superAdmin = User::factory()->make([
            'role_id' => 1,
        ]);

        $faker = Factory::create();

        $approverAdmin = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
            'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role_id' => 2
        ];

        $response = $this->actingAs($superAdmin)->postJson('dashboard/users',$approverAdmin);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'name' => $approverAdmin['name'],
            'role_id' => 2,
        ]);

    }

    public function testCanUpdateApproverAdmin()
    {
        $superAdmin = User::factory()->make([
            'role_id' => 1,
        ]);

        $faker = Factory::create();

        $approverAdmin = User::factory()->create([
            'role_id' => 2,
        ]);

        $updatedName = $faker->name;
        $response = $this->actingAs($superAdmin)->patchJson('dashboard/users/'.$approverAdmin->id,[
            'name' => $updatedName,
            'email' => $approverAdmin->email,
            'photo_alt' => 'User Photo',
            'role_id' => 2
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'id' => $approverAdmin->id,
            'name' => $updatedName,
            'role_id' => 2,
        ]);

    }
}
