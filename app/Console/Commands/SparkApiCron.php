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

        // $client = new \GuzzleHttp\Client([
        //     'base_uri' => 'https://resoapi.rmlsweb.com/reso/odata/',
        //     'headers' => [
        //         'Authorization' => 'Bearer ac82e3e1bc0016aca5529cf4577d0093',
        //         'Accept' => 'application/json'
        //     ]
        // ]);

        // $response = $client->get('Property');

        // $dataList = json_decode($response->getBody(), true);
        // // return response()->json($dataList['value'][0]);
        // //save data in database from api
        // Property::create([
        //     'availableDate' => $dataList['value'][0]['OnMarketDate'],
        //     'expireDate' => $dataList['value'][0]['CloseDate'],
        //     'price' => $dataList['value'][0]['ListPrice'],
        //     'originalPrice' => $dataList['value'][0]['OriginalListPrice'],
        //     'previewText' => $dataList['value'][0]['PublicRemarks'],
        //     // 'callForPrice' => $dataList['value'][0]['AuctionAssessedPrice'],
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        Log::info("Cron is working fine!");
    }
}
