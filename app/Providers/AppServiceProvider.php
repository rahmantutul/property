<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $authUser=[];
        // if(session()->has('authUser')){
        //     $authUser=session()->get('authUser');
        // } 
        // else{
        //     if(auth()->guard('staff')->check()){
        //      $authUser=auth()->guard('staff')->user();
        //      session()->put('authUser',$authUser);
        //     }
        // }
        // $viewShare['authUser']=$authUser;
        // View::share($viewShare);
    }
}
