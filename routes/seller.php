<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Seller\HelpDeskController;
use App\Http\Controllers\Seller\PropertyController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\TransectionController;
use App\Http\Controllers\Admin\MarketActivityController;

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

	Route::group(['prefix'=>'seller','as'=>'seller.'],function(){
		Route::get('edit',[SellerController::class,'editProfile'])->name('editProfile');
		Route::post('update',[SellerController::class,'updateProfile'])->name('updateProfile');
	});


	Route::get('/',[DashboardController::class,'dashboard'])->name('index');

	Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

	Route::group(['prefix'=>'help/desk','as'=>'helpDesk.'],function(){

		// Route::get('/',[HelpDeskController::class,'index'])->name('index');
		Route::get('/',[InboxController::class,'index'])->name('index');
		Route::get('/{id}',[InboxController::class,'show'])->name('show');
		
		Route::get('/messages',[HelpDeskController::class,'messages'])->name('messages');

		Route::post('/send/message',[HelpDeskController::class,'sendMessage'])->name('sendMessage');
	});

	// for properties
	Route::group(['prefix'=>'property','as'=>'property.'],function(){

		Route::get('/',[PropertyController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[PropertyController::class,'changeStatus'])->name('status.change');

		Route::get('{dataId}/feature/{is_featured}/change',[PropertyController::class,'changeFeature'])->name('feature.change');

		Route::get('/{dataId}/edit',[PropertyController::class,'edit'])->name('edit');

		Route::post('/update',[PropertyController::class,'update'])->name('update');

		Route::post('/',[PropertyController::class,'store'])->name('store');

		Route::get('/create',[PropertyController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[PropertyController::class,'destroy'])->name('delete');	

	});
	Route::group(['prefix'=>'marketActivity','as'=>'marketActivity.'],function(){

		Route::get('/',[MarketActivityController::class,'index'])->name('index');

    
	});


	Route::group(['prefix'=>'transection','as'=>'transection.'],function(){

		Route::get('/',[TransectionController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[TransectionController::class,'changeStatus'])->name('status.change');

		Route::get('/{dataId}/edit',[TransectionController::class,'edit'])->name('edit');

		Route::post('/update',[TransectionController::class,'update'])->name('update');

		Route::post('/',[TransectionController::class,'store'])->name('store');

		Route::get('/create',[TransectionController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[TransectionController::class,'destroy'])->name('delete');	

	});

});	
