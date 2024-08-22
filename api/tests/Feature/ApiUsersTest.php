<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Weather;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiUsersTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        User::factory(20)->create();
        Weather::factory(20)->create();
    }

    public function test_users_list_endpoint(): void
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                [
                    'id',
                    'name',
                    'email',
                    'latitude',
                    'longitude',
                    'created_at',
                    'updated_at',
                    'weather' => [
                        'id',
                        'data',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]);
    }

    public function test_get_user_endpoint(): void
    {
        $userId = User::all()->random()->first()->id;
        $response = $this->get("/users/{$userId}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
                'latitude',
                'longitude',
                'created_at',
                'updated_at'
            ],
            'latitudeAndLongitude'
        ]);
    }
}
