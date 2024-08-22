<?php
namespace App\Interfaces;

interface WeatherServiceInterface{
    public function getUrl(string $lat, string $long): string;
    public function getWeatherByLatLong(string $lat, string $long): array;
}
