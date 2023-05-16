<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SparkApiPopertyController extends Controller
{
    public function index(){
        $client = new Client([
            'base_uri' => 'https://resoapi.rmlsweb.com/reso/odata/Property',
            'headers' => [
                'Authorization' => 'Bearer ' . env('SPARK_API_ACCESS_TOKEN'),
                'Accept' => 'application/json'
            ]
        ]);
    }
}
