<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;

class RemoveOldCarts extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // Sintaxis = 'categoría:comando'
    protected $signature = 'carts:remove-old {--days=7 : Los días tras los que se eliminará el carrito.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina carritos más antiguos que los días que especifiquemos.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $deadline = now()->subDays($this->option('days'));

        $counter = Cart::whereDate('updated_at', '<=', $deadline)->delete();

        $this->info("Hecho. Se han eliminado {$counter} carritos.");
    }
}