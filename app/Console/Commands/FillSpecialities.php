<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Support\Speciality;

class FillSpecialities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-specialities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill in the specialities table';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Speciality::fill();
    }
}