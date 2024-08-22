<?php
namespace App\Repositories;

use App\Interfaces\CacheInterface;
use Illuminate\Support\Facades\Cache;

class CacheRepository implements CacheInterface {
    /**
     * @param string|null $key
     * @return mixed|null
     */
    public function getFromCache(string $key = null): mixed{
        if(empty($key)){
            return null;
        }

        return Cache::get($key);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function saveToCache(string $key, mixed $value): void{
        Cache::put($key, $value, config('cache.ttl'));
    }
}
