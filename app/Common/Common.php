<?php

namespace App\Common;

use Illuminate\Support\Facades\Http;

class Common
{

    public static function APIWiseFetchableMetaData()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('SPARK_API_ACCESS_TOKEN'),
        ])->get('https://resoapi.rmlsweb.com/reso/odata');

        if ($response->successful()) {
            return json_decode($response->body(), true);
        } else {
            return respondError('Opps! Sorry, we do not found any data from api.', $response->serverError(), 500);
        }
    }

    public static function APIWiseFetchableMetaDataUsingPHPCURL()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://resoapi.rmlsweb.com/reso/oodata',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('SPARK_API_ACCESS_TOKEN')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if (!empty($response)) {
            return json_decode($response, true);
        } else {
            return respondError('Opps! Sorry, we do not found any data from api.', [], 500);
        }
    }
}
