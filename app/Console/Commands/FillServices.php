<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Actions\FillServices as FillServicesAction;

class FillServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill in the services table';

    /**
     * Execute the console command.
     */
    public function handle(FillServicesAction $action)
    {
        $action->handle();
    }
}