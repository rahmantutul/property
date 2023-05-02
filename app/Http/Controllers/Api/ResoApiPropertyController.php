<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use App\Models\ResoapiProperties;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Guzzle\Http\Exception\ClientErrorResponseException;

class ResoApiPropertyController extends Controller
{
    public function store()
    {
        $client = new Client([
            'base_uri' => 'https://resoapi.rmlsweb.com/reso/odata/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('SPARK_API_ACCESS_TOKEN'),
                'Accept' => 'application/json'
            ]
        ]);
        return response()->json($client['value'][0]);

        //try catch block for property add from api
        try {
            DB::beginTransaction();
            //property table truncate
            Schema::disableForeignKeyConstraints();
            DB::table('resoapi_properties')->truncate();

            $response = $client->get('Property');
            $dataList = json_decode($response->getBody(), true);
            //foreach loop for property add from api
            foreach ($dataList['value'] as $data) {
                //save data in database from api
                ResoapiProperties::create([
                    'BathroomsTotalInteger' => ($data['BathroomsTotalInteger'] === 'null') ? null : $data['BathroomsTotalInteger'],
                    'BedroomsTotal' => ($data['BedroomsTotal'] === 'null') ? null : $data['BedroomsTotal'],
                    'BuildingAreaTotal' => ($data['BuildingAreaTotal'] === 'null') ? null : $data['BuildingAreaTotal'],
                    'BuyerOfficeName' => ($data['BuyerOfficeName'] === 'null') ? null : $data['BuyerOfficeName'],
                    'BuyerOfficePhone' => ($data['BuyerOfficePhone'] === 'null') ? null : $data['BuyerOfficePhone'],
                    'City' => ($data['City'] === 'null') ? null : $data['City'],
                    'CloseDate' => ($data['CloseDate'] === 'null') ? null : $data['CloseDate'],
                    'ClosePrice' => ($data['ClosePrice'] === 'null') ? null : round($data['ClosePrice']),
                    'CondominiumElevatorYN' => ($data['CondominiumElevatorYN'] === 'null') ? null : $data['CondominiumElevatorYN'],
                    'CondominiumGarageType' => ($data['CondominiumGarageType'] === 'null') ? null : $data['CondominiumGarageType'],
                    'Country' => ($data['Country'] === 'null') ? null : $data['Country'],
                    'CurrentPriceForStatus' => ($data['CurrentPriceForStatus'] === 'null') ? null : round($data['CurrentPriceForStatus']),
                    'Directions' => ($data['Directions'] === 'null') ? null : $data['Directions'],
                    'GarageSpaces' => ($data['GarageSpaces'] === 'null') ? null : $data['GarageSpaces'],
                    'GarageType' => ($data['GarageType'] === 'null') ? null : $data['GarageType'],
                    'Latitude' => ($data['Latitude'] === 'null') ? null : $data['Latitude'],
                    'ListPrice' => ($data['ListPrice'] === 'null') ? null : $data['ListPrice'],
                    'Longitude' => ($data['Longitude'] === 'null') ? null : $data['Longitude'],
                    'ListingId' => ($data['ListingId'] === 'null') ? null : $data['ListingId'],
                    'LotSizeDimensions' => ($data['LotSizeDimensions'] === 'null') ? null : $data['LotSizeDimensions'],
                    'LotSizeSquareFeet' => ($data['LotSizeSquareFeet'] === 'null') ? null : round($data['LotSizeSquareFeet']),
                    'MainLevelAreaTotal' => ($data['MainLevelAreaTotal'] === 'null') ? null : $data['MainLevelAreaTotal'],
                    'ParkingTotal' => ($data['ParkingTotal'] === 'null') ? null : $data['ParkingTotal'],
                    'Photo1URL' => ($data['Photo1URL'] === 'null') ? null : $data['Photo1URL'],
                    'PropertyType' => ($data['PropertyType'] === 'null') ? null : $data['PropertyType'],
                    'PropertySubType' => ($data['PropertySubType'] === 'null') ? null : $data['PropertySubType'],
                    'PublicRemarks' => ($data['PublicRemarks'] === 'null') ? null : $data['PublicRemarks'],
                    'StreetName' => ($data['StreetName'] === 'null') ? null : $data['StreetName'],
                    'StreetNumber' => ($data['StreetNumber'] === 'null') ? null : $data['StreetNumber'],
                    'StreetNumberNumeric' => ($data['StreetNumberNumeric'] === 'null') ? null : $data['StreetNumberNumeric'],
                    'YearBuilt' => ($data['YearBuilt'] === 'null') ? null : $data['YearBuilt'],
                    'PostalCode' => ($data['PostalCode'] === 'null') ? null : $data['PostalCode'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
            DB::commit();
        } catch (ClientErrorResponseException $e) {
            DB::rollback();
            \log($e->getMessage());
        }
    }
}
