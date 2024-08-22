<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Dispatcher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateWeatherForAllUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $lastUser = User::latest('id')->get();
            User::with(['weather'])
                ->chunk(100, function ($users) {
                    foreach ($users as $user) {
                        // Add to a new queue to be processed simultaneously, perhaps with supervisor
                        dispatch(new UpdateWeatherForUser($user, User::latest('id')->first()->id))
                            ->onQueue('default');
                    }
                });
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
