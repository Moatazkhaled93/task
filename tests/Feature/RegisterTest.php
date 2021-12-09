<?php

namespace Tests\Feature;

use App\Models\Entity;
use Illuminate\Support\Facades\DB;
use Tests\MigrateFreshSeedOnce;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use MigrateFreshSeedOnce;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegistrationSuccessful()
    {
        $response = $this->post(route('register'), [
            'first_name' => 'Richard',
            'last_name' => 'Skinner',
            'email' => 'r.skinner@lamasatech.com',
            'phone' => '07766415880',
            'password' => 'password',
            'entity' => [
                'name' => 'Lamasatech',
                'subdomain' => 'lt',
                'kiosks' => 5,
            ]
        ]);

        $this->assertDatabaseHas('users', [
            'first_name' => 'Richard',
            'last_name' => 'Skinner',
            'email' => 'r.skinner@lamasatech.com',
            'phone' => '07766415880',
        ]);

        $this->assertDatabaseHas('entities', [
            'name' => 'Lamasatech',
            'subdomain' => 'lt',
            'kiosks' => 5,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'message',
            'data',
        ]);
    }

    public function testRegistrationUnsuccessful()
    {
        $response = $this->followingRedirects()->post(route('register'), [
            'first_name' => 'Richard',
            'last_name' => 'Skinner',
            'email' => 'r.skinner@lamasatech.com',
            'phone' => '07766415880',
            'password' => 'password',
        ]);

        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors('entity.name', 'The entity.name field is required.');
        $response->assertSessionHasErrors('entity.subdomain', 'The entity.subdomain field is required.');
        $response->assertSessionHasErrors('entity.kiosks', 'The entity.kiosks field is required.');
    }
}
