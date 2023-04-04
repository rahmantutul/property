<?php

use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Agent\AgentContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\Agent\HelpDeskController;
use App\Http\Controllers\Agent\PropertyController;
use App\Http\Controllers\Agent\TransectionController;

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

Route::group(['prefix'=>'agent','middleware'=>'AgentAuth','as'=>'agent.'],function(){

	Route::get('/',[DashboardController::class,'dashboard'])->name('index');

	Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

	Route::group(['prefix'=>'help/desk','as'=>'helpDesk.'],function(){

		Route::get('/',[HelpDeskController::class,'index'])->name('index');
		
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

	// for properties
	Route::group(['prefix'=>'transection','as'=>'transection.'],function(){

		Route::get('/',[TransectionController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[TransectionController::class,'changeStatus'])->name('status.change');

		Route::get('/{dataId}/edit',[TransectionController::class,'edit'])->name('edit');

		Route::post('/update',[TransectionController::class,'update'])->name('update');

		Route::post('/',[TransectionController::class,'store'])->name('store');

		Route::get('/create',[TransectionController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[TransectionController::class,'destroy'])->name('delete');	

	});

	Route::group(['prefix'=>'agent','as'=>'agent.'],function(){
		Route::get('edit',[AgentController::class,'editProfile'])->name('editProfile');
		Route::post('update',[AgentController::class,'updateProfile'])->name('updateProfile');
	});
	Route::group(['prefix'=>'message','as'=>'message.'],function(){
		Route::get('index',[AgentContactController::class,'index'])->name('index');
		Route::get('/{dataId}/view',[AgentContactController::class,'view'])->name('view');
		Route::delete('{dataId}/delete',[AgentContactController::class,'destroy'])->name('destroy');	
	});
});	
