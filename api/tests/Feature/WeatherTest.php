<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Weather;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    use RefreshDatabase;

    public function test_weather_database_works()
    {
        User::factory(20)->create();
        Weather::factory(20)->create();

        $this->assertEquals(20, Weather::all()->count());
    }
}
