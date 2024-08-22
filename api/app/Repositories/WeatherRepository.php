<?php
namespace App\Repositories;

use App\Interfaces\CacheInterface;
use App\Interfaces\WeatherInterface;
use App\Interfaces\WeatherServiceInterface;
use App\Models\User;
use App\Models\Weather;

class WeatherRepository implements WeatherInterface{
    protected CacheInterface $cacheInterface;
    protected WeatherServiceInterface $weatherService;

    public function __construct(CacheInterface $cacheInterface, WeatherServiceInterface $weatherService){
        $this->cacheInterface = $cacheInterface;
        $this->weatherService = $weatherService;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getUserWeather(User $user): array{
        $key = $this->weatherService->getUrl($user->latitude, $user->longitude);
        $cache = $this->cacheInterface->getFromCache($key);
        if($cache){
            return $cache;
        }

        // If user have a wather register, but it's older than 1 hour will ignore this and call api again
        if($user->weather && !now()->subSeconds(config('cache.ttl'))->greaterThan($user->weather->updated_at)){
            $weather = $user->weather->toArray();
            $this->cacheInterface->saveToCache($key, $weather);
            return $weather;
        }

        $weather = $this->weatherService->getWeatherByLatLong($user->latitude, $user->longitude);
        if($weather){
            $this->saveUpdateWeather($user, $weather);
            $this->cacheInterface->saveToCache($key, $weather);
        }

        return $weather;
    }

    /**
     * @param User $user
     * @param array $data
     * @return void
     */
    public function saveUpdateWeather(User $user, array $data): void{
        if(!$user->weather){
            $weatherModel = new Weather();
            $weatherModel->data = $data;
            $user->weather()->save($weatherModel);
        }else{
            $user->weather()->update([
                'data' => $data
            ]);
        }
    }
}
