<?php
namespace App\Interfaces;

interface CacheInterface{
    public function getFromCache(string $key = null): mixed;
    public function saveToCache(string $key, mixed $value): void;
}
