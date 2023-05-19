<?php

namespace App\Console\Commands;

use App\Http\Controllers\OreGonController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
class OregonApiCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oregonapi:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Oregon API Cron for property data';

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
         // api Meta data from Oregon api store in database
        $request = new OreGonController();
        $request->store();

        Log::info("Oregon API Cron is working fine!");
    }
}
