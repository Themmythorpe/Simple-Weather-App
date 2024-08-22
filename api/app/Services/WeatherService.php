<?php
namespace App\Services;

use App\Interfaces\CacheInterface;
use App\Interfaces\WeatherServiceInterface;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService implements WeatherServiceInterface {
    protected CacheInterface $cacheInterface;

    public function __construct(CacheInterface $cacheInterface){
        $this->cacheInterface = $cacheInterface;
    }

    /**
     * @return string
     */
    protected function getWeatherApiUrl(): string{
        $url = config('app.open_weather_url');
        return strpos($url, -1) != '?' ? $url . '?' : $url;
    }

    /**
     * @return string
     */
    protected function getWeatherApiSecretKey(): string{
        return config('app.open_weather_secret_key');
    }

    /**
     * @param string $lat
     * @param string $long
     * @return string
     */
    public function getUrl(string $lat, string $long): string{
        $queryParams = [
            'lat' => $lat,
            'lon' => $long,
            'appId' => $this->getWeatherApiSecretKey(),
        ];

        return $this->getWeatherApiUrl() . http_build_query($queryParams);
    }

    /**
     * @param string $lat
     * @param string $long
     * @return array
     */
    public function getWeatherByLatLong(string $lat, string $long): array{
        try{
            $url = $this->getUrl($lat, $long);
            $response = Http::get($url);
            $response = json_decode($response, true);
            $response['updated_at'] = date('Y-m-d H:i:s');

            $this->cacheInterface->saveToCache($url, $response);
            return $response;
        }catch (HttpClientException $e){
            Log::error($e->getMessage());
            Log::info($e->getTraceAsString());
        }

        return [];
    }
}
