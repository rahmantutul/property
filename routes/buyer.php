<?php

use App\Http\Controllers\Admin\BuyerController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\MarketActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\Buyer\HelpDeskController;
use App\Http\Controllers\Buyer\DashboardController;
use App\Http\Controllers\Buyer\PropertyController;

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

// Auth::routes();

Route::group(['prefix'=>'buyer','middleware'=>'BuyerAuth','as'=>'buyer.'],function(){

	Route::get('/',[DashboardController::class,'dashboard'])->name('index');

	Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

	Route::group(['prefix'=>'buyer','as'=>'profile.'],function(){
		Route::get('/edit',[BuyerController::class,'editProfile'])->name('edit');
		Route::post('/update',[BuyerController::class,'updateProfile'])->name('update');
	});

	Route::group(['prefix'=>'help/desk','as'=>'helpDesk.'],function(){

		Route::get('/',[InboxController::class,'index'])->name('index');
		Route::get('/{id}',[InboxController::class,'show'])->name('show');
		
		Route::get('/messages',[HelpDeskController::class,'messages'])->name('messages');

		Route::post('/send/message',[HelpDeskController::class,'sendMessage'])->name('sendMessage');
	});
	Route::group(['prefix'=>'marketActivity','as'=>'marketActivity.'],function(){

		Route::get('/',[MarketActivityController::class,'index'])->name('index');

    
	});
	
	Route::group(['prefix'=>'downloads','as'=>'downloads.'],function(){
		Route::get('/',[DownloadController::class,'index'])->name('index');
	});

	// for properties
	Route::group(['prefix'=>'property','as'=>'property.'],function(){

		Route::get('/saved-property',[PropertyController::class,'saved'])->name('saved');
		
	});
});	
