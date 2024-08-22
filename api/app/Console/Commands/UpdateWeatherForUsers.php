<?php

namespace App\Console\Commands;

use App\Jobs\UpdateWeatherForAllUsers;
use App\Models\User;
use Illuminate\Bus\Dispatcher;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class UpdateWeatherForUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-weather-for-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call the jobs to update every users weather';

    /**
     * @return int
     */
    public function handle(): int
    {
        if(empty(config('app.open_weather_url'))
            || (empty(config('app.open_weather_secret_key')) || config('app.open_weather_secret_key') == 'YOUR_SECRET_KEY')){
            $this->error("Please, configure 'OPEN_WEATHER_URL' and 'OPEN_WEATHER_SECRET_KEY' to your .env file");
            return 1;
        }

        // Flush the cache first :).
        cache()->flush();
        app(Dispatcher::class)
            ->dispatch(new UpdateWeatherForAllUsers());

        $this->info('Added queues to fetch weather info for all users');

        return 0;
    }
}
