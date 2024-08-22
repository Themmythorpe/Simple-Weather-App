<?php

namespace App\Jobs;

use App\Interfaces\WeatherInterface;
use App\Interfaces\WeatherServiceInterface;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateWeatherForUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;
    protected int $lastUserId;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, ?int $lastUserId = null)
    {
        $this->user = $user;
        $this->lastUserId = $lastUserId;
    }

    /**
     * Execute the job.
     */
    public function handle(WeatherServiceInterface $weatherService, WeatherInterface $weatherInterface): void
    {
        try{
            $data = $weatherService->getWeatherByLatLong($this->user->latitude, $this->user->longitude);
            $weatherInterface->saveUpdateWeather($this->user, $data);

            // If it's the last user, save the cache for pagination
            if($this->user->id === $this->lastUserId){
                cache()->put('all-users', User::with('weather')->get());
            }
        }catch (\Exception $e){
            report($e);
        }
    }
}
