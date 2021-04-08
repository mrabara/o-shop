<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;

class RemoveOldCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carts:remove {--days=7: Days after which the carts will be removed.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expired carts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deadline = now()->subDays($this->option('days'));

        $counter = Cart::whereDate('updated_at', '<=', $deadline)->delete();

        $this->info("{$counter} carts were removed.");

    }
}
