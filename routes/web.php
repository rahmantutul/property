<?php

use App\Http\Controllers\Admin\PropertyMessageController;
use App\Http\Controllers\Agent\AgentContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as LoginController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\SavePropertyController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RahmanController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    Session::flash('msg',"Cache is cleared");
    return redirect()->back();
})->name('clear.cache');

Route::get('/',[FrontendController::class,'home'])->name('front.home');

Route::group(['prefix'=>'front','as'=>'front.'],function(){
    Route::get('/user-login',[FrontendController::class,'login'])->name('login');
    Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
    Route::get('/neighbour',[FrontendController::class,'neighbourHood'])->name('neighbourHood');
    Route::get('/{dataId}/neighbour-details',[FrontendController::class,'neighbourDetails'])->name('neighbourDetails');
    Route::get('/property',[FrontendController::class,'property'])->name('property');
    Route::get('/property/details/{id}',[FrontendController::class,'propertyDetails'])->name('propertyDetails');
    Route::get('/signup',[FrontendController::class,'signup'])->name('signup');
    Route::get('/property/search',[FrontendController::class,'searchProperty'])->name('propertySearch');
    Route::post('/property/page/search',[SearchController::class,'searchProperty'])->name('propertyPageSearch');
    Route::get('/agents',[FrontendController::class,'agents'])->name('agents');
    Route::get('/agents-details/{username}',[FrontendController::class,'agentDetails'])->name('agentDetails');
    Route::get('/save-property/{id}', [SavePropertyController::class, 'saveProperty'])->name('saveProperty');
});


Route::get('/login',[LoginController::class,'loginPage'])->name('login')->middleware('AuthCheck');
Route::post('/login',[LoginController::class,'login'])->name('login');

Route::post('/register',[LoginController::class,'registerUser'])->name('user.register');


Route::get('/logout',[LoginController::class,'logout'])->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Auth::routes();
Route::group(['prefix'=>'agent/message','as'=>'agent.message.'],function(){
    Route::post('/',[AgentContactController::class,'store'])->name('store');
});

// Auth::routes();
Route::group(['prefix'=>'property/message','as'=>'property.'],function(){
    Route::post('/',[FrontendController::class,'property_message'])->name('message.store');
    Route::get('{dataId}/view',[PropertyMessageController::class,'message_view'])->name('message.view');
    Route::get('{id}/delete',[PropertyMessageController::class,'message_delete'])->name('message.delete');
});
Route::get('/{dataId}/blog-details',[HomeController::class,'blogDetails'])->name('marketActivity.details');
