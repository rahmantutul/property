<?php

namespace App\Console\Commands;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SparkApiCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sparkapi:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spark API Cron for property data';

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
        // api property data from spark api store in database route call
        $request = Request::create('/api/store', 'GET');
        app()->handle($request);
        Log::info("Cron is working fine!");
    }
}
