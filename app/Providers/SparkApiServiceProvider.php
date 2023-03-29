<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class SparkApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $client = new Client([
                'base_uri' => 'https://api.spark.com/',
                'headers' => [
                    'Authorization' => 'Bearer ' . env('SPARK_API_ACCESS_TOKEN'),
                    'Accept' => 'application/json',
                ],
            ]);

            return $client;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
