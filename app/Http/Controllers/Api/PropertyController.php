<?php

namespace App\Http\Controllers\Api;

use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Guzzle\Http\Exception\ClientErrorResponseException;

class PropertyController extends Controller
{
    public function index(){
        $client = new \GuzzleHttp\Client([
          'base_uri' => 'https://resoapi.rmlsweb.com/reso/odata/',
          'headers' => [
              'Authorization' => 'Bearer ' . env('SPARK_API_ACCESS_TOKEN'),
              'Accept' => 'application/json'
          ]
      ]);
      $response = $client->get('Property');

      $data = json_decode($response->getBody(), true);

    }    


    public function store(){


            $client = new \GuzzleHttp\Client([
                'base_uri' => 'https://resoapi.rmlsweb.com/reso/odata/',
                'headers' => [
                    'Authorization' => 'Bearer ' . env('SPARK_API_ACCESS_TOKEN'),
                    'Accept' => 'application/json'
                ]
            ]);
            // return response()->json($dataList['value'][0]);

            //try catch block for property add from api
            try {
                DB::beginTransaction();
                //property table trunacate
                Schema::disableForeignKeyConstraints();
                DB::table('properties')->truncate();

                $response = $client->get('Property');
                $dataList = json_decode($response->getBody(), true);
                //foreach loop for property add from api
                foreach ($dataList['value'] as $data) {
                    //save data in database from api
                    Property::create([
                        'agentId' => 0,
                        'buyerId' => 0,
                        'sellerId' => 0,
                        'typeId' => 1,
                        'garageTypeId' => 1,
                        'mlsId' => Str::random(10),
                        'title' => $data['OriginatingSystemName'],
                        'slug' => Str::slug($data['OriginatingSystemName']),
                        'availableDate' => $data['OnMarketDate'],
                        'expireDate' => $data['CloseDate'],
                        'price' => $data['ListPrice'],
                        'originalPrice' => $data['OriginalListPrice'],
                        'previewText' => $data['PublicRemarks'],
                        'thumbnail' => $data['Photo1URL'],
                        'virtualTour' => $data['UnparsedAddress'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    DB::commit();
                }

            } catch (ClientErrorResponseException $e) {
                DB::rollback();
                \log($e->getMessage());
            }


    }

}


