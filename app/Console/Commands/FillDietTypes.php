<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Support\DietType;

class FillDietTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-diet-types';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DietType::fill();
    }
}