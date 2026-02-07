<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Actions\FillDietaryOptions as FillDietaryOptionsAction;

class FillDietaryOptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-dietary-options';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill in the dietary options table';

    /**
     * Execute the console command.
     */
    public function handle(FillDietaryOptionsAction $action): void
    {
        $action->handle();
    }
}