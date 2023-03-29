<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\HelpDeskController;

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

Route::group(['prefix'=>'seller','middleware'=>'SellerAuth','as'=>'seller.'],function(){

	Route::get('/',[DashboardController::class,'dashboard'])->name('index');

	Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

	Route::group(['prefix'=>'help/desk','as'=>'helpDesk.'],function(){

		Route::get('/',[HelpDeskController::class,'index'])->name('index');
		
		Route::get('/messages',[HelpDeskController::class,'messages'])->name('messages');

		Route::post('/send/message',[HelpDeskController::class,'sendMessage'])->name('sendMessage');
	});

});	
