<?php

namespace Modules\ShopFlow\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Modules\ShopFlow\Models\cart;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ExpireCarts extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'carts:delete-expired';

    /**
     * The console command description.
     */
    protected $description = 'delete old cart on pending';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expireCarts = cart::query()->where('status','pending')
            ->where('created_at','<',Carbon::now()->subHours(48))
            ->get();

        foreach ($expireCarts as $order)
        {
            $order->delete();
        }
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
