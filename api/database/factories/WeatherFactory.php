<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weather>
 */
class WeatherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'data' => '{"dt": 1678284836, "id": 0, "cod": 200, "sys": {"sunset": 1678340684, "sunrise": 1678289163}, "base": "stations", "main": {"temp": 265.66, "humidity": 77, "pressure": 994, "temp_max": 265.66, "temp_min": 265.66, "sea_level": 994, "feels_like": 258.66, "grnd_level": 994}, "name": "", "wind": {"deg": 234, "gust": 11.43, "speed": 7.48}, "coord": {"lat": -71.4536, "lon": -156.1213}, "clouds": {"all": 98}, "weather": [{"id": 804, "icon": "04n", "main": "Clouds", "description": "overcast clouds"}], "timezone": -36000, "updated_at": "2023-03-08 14:14:20", "visibility": 10000}'
        ];
    }
}
