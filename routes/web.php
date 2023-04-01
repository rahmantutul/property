<?php

use App\Http\Controllers\Agent\AgentContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as LoginController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\RahmanController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    Artisan::call('optimize:clear');
    return "Cache is cleared";
});

Route::get('/',[FrontendController::class,'home'])->name('front.home');

Route::group(['prefix'=>'front','as'=>'front.'],function(){
    Route::get('/user-login',[FrontendController::class,'login'])->name('login');
    Route::get('/neighbour',[FrontendController::class,'neighbourHood'])->name('neighbourHood');
    Route::get('/property',[FrontendController::class,'property'])->name('property');
    Route::get('/signup',[FrontendController::class,'signup'])->name('signup');
    Route::get('/property/search',[FrontendController::class,'searchProperty'])->name('propertySearch');
    Route::get('/agents',[FrontendController::class,'agents'])->name('agents');
    Route::get('/{dataId}/agents-details',[FrontendController::class,'agentDetails'])->name('agentDetails');
});

// Auth::routes();

Route::get('/login',[LoginController::class,'loginPage'])->name('login')->middleware('AuthCheck');
Route::post('/login',[LoginController::class,'login'])->name('login');

Route::post('/register',[LoginController::class,'registerUser'])->name('user.register');


Route::get('/logout',[LoginController::class,'logout'])->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'agent/message','as'=>'agent.message.'],function(){
    Route::post('/',[AgentContactController::class,'store'])->name('store');
});

