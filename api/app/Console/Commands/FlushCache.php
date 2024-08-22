<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FlushCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:flush-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush Redis or configured cache';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        cache()->flush();
        $this->info('Flushed cache!');
    }
}
