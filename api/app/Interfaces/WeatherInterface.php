<?php
namespace App\Interfaces;

use App\Models\User;

interface WeatherInterface{
    public function getUserWeather(User $user): array;
    public function saveUpdateWeather(User $user, array $data): void;
}
