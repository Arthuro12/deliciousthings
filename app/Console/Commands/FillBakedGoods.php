<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Actions\FillBakedGoods as FillBakedGoodsAction;

class FillBakedGoods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-baked-goods';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill in the baked goods table';

    /**
     * Execute the console command.
     */
    public function handle(FillBakedGoodsAction $action): void
    {
        $action->handle();
    }
}