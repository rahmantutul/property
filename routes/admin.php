<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\BuyerController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\NeighbourController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AmenityTypeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\GarageTypeController;
use App\Http\Controllers\Admin\MarketActivityController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\TransectionController;
use App\Http\Controllers\Admin\HelpDeskController;
use App\Http\Controllers\Admin\ResoPropertyController;
use App\Http\Controllers\Admin\WebsiteSettingController;

// Auth::routes();

Route::group(['prefix'=>'admin','middleware'=>'AdminAuth','as'=>'admin.'],function(){

	Route::get('/',[DashboardController::class,'dashboard'])->name('index');

	Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

	Route::group(['prefix'=>'admin','as'=>'admin.'],function(){

		Route::get('list',[AdminController::class,'index'])->name('index');
		
		Route::get('create',[AdminController::class,'create'])->name('create');
		
		Route::get('{dataId}/edit',[AdminController::class,'edit'])->name('edit');
		
		Route::post('store',[AdminController::class,'store'])->name('store');
		
		Route::post('update',[AdminController::class,'update'])->name('update');

		Route::delete('{dataId}/delete',[AdminController::class,'destroy'])->name('delete');
		
		Route::get('{dataId}/status/{status}/change',[AdminController::class,'changeStatus'])->name('status.change');
	});

	Route::group(['prefix'=>'agent','as'=>'agent.'],function(){

		Route::get('list',[AgentController::class,'index'])->name('index');
		
		Route::get('create',[AgentController::class,'create'])->name('create');
		
		Route::get('{dataId}/edit',[AgentController::class,'edit'])->name('edit');
		
		Route::post('store',[AgentController::class,'store'])->name('store');
		
		Route::post('update',[AgentController::class,'update'])->name('update');
		
		Route::delete('{dataId}/delete',[AgentController::class,'destroy'])->name('delete');

		Route::get('{dataId}/status/{status}/change',[AgentController::class,'changeStatus'])->name('status.change');
	});

	Route::group(['prefix'=>'buyer','as'=>'buyer.'],function(){

		Route::get('list',[BuyerController::class,'index'])->name('index');
		
		Route::get('create',[BuyerController::class,'create'])->name('create');
		
		Route::get('{dataId}/edit',[BuyerController::class,'edit'])->name('edit');
		
		Route::post('store',[BuyerController::class,'store'])->name('store');
		
		Route::post('update',[BuyerController::class,'update'])->name('update');
		
		Route::delete('{dataId}/delete',[BuyerController::class,'destroy'])->name('delete');

		Route::get('{dataId}/status/{status}/change',[BuyerController::class,'changeStatus'])->name('status.change');
	});

	Route::group(['prefix'=>'seller','as'=>'seller.'],function(){

		Route::get('list',[SellerController::class,'index'])->name('index');
		
		Route::get('create',[SellerController::class,'create'])->name('create');
		
		Route::get('{dataId}/edit',[SellerController::class,'edit'])->name('edit');
		
		Route::post('store',[SellerController::class,'store'])->name('store');
		
		Route::post('update',[SellerController::class,'update'])->name('update');
		
		Route::delete('{dataId}/delete',[SellerController::class,'destroy'])->name('delete');

		Route::get('{dataId}/status/{status}/change',[SellerController::class,'changeStatus'])->name('status.change');
	});

	Route::group(['prefix'=>'neighbour', 'as'=>'neighbour.'],function(){

	    Route::get('index',[NeighbourController::class,'index'])->name('index');

	    Route::get('/status/change',[NeighbourController::class,'changeStatus'])->name('status.change');

	    Route::get('{dataId}/edit',[NeighbourController::class,'edit'])->name('edit');

	    Route::post('update',[NeighbourController::class,'update'])->name('update');

	    Route::get('create',[NeighbourController::class,'create'])->name('create');

	    Route::post('store',[NeighbourController::class,'store'])->name('store');
	    
	    Route::delete('{dataId}/delete',[NeighbourController::class,'destroy'])->name('delete');
	});

	// for designation/role
	Route::group(['prefix'=>'designation','as'=>'role.'],function(){

		Route::get('/',[RoleController::class,'index'])->name('index');

		Route::get('/status/change',[RoleController::class,'changeStatus'])->name('status.change');

		Route::get('/{dataId}/edit',[RoleController::class,'edit'])->name('edit');

		Route::post('/update',[RoleController::class,'update'])->name('update');

		Route::post('/',[RoleController::class,'store'])->name('store');

		Route::get('/create',[RoleController::class,'create'])->name('create');

		Route::delete('/{id}',[RoleController::class,'destroy'])->name('delete');
	});

	// for permission entry
	Route::group(['prefix'=>'permission','as'=>'permission.'],function(){

		Route::get('/',[PermissionController::class,'index'])->name('index');

		Route::get('/status/change',[PermissionController::class,'changeStatus'])->name('status.change');

		Route::get('/{dataId}/edit',[PermissionController::class,'edit'])->name('edit');

		Route::post('/update',[PermissionController::class,'update'])->name('update');

		Route::post('/',[PermissionController::class,'store'])->name('store');

		Route::get('/create',[PermissionController::class,'create'])->name('create');

		Route::delete('/{id}',[PermissionController::class,'destroy'])->name('delete');
	});


	Route::group(['prefix'=>'aminety/type','as'=>'aminetyType.'],function(){

		Route::get('/',[AmenityTypeController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[AmenityTypeController::class,'changeStatus'])->name('status.change');


		Route::get('/{dataId}/edit',[AmenityTypeController::class,'edit'])->name('edit');

		Route::post('/update',[AmenityTypeController::class,'update'])->name('update');

		Route::post('/',[AmenityTypeController::class,'store'])->name('store');

		Route::get('/create',[AmenityTypeController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[AmenityTypeController::class,'destroy'])->name('delete');

	});

	// for banners
	Route::group(['prefix'=>'banner','as'=>'banner.'],function(){

		Route::get('/',[WebsiteSettingController::class,'banner'])->name('edit');
		Route::post('/update',[WebsiteSettingController::class,'bannerupdate'])->name('update');
	});

	// for banners
	Route::group(['prefix'=>'info','as'=>'info.'],function(){
		Route::get('/',[WebsiteSettingController::class,'info'])->name('edit');
		Route::post('/update',[WebsiteSettingController::class,'infoupdate'])->name('update');
	});

	// for category
	Route::group(['prefix'=>'category','as'=>'category.'],function(){

		Route::get('/',[CategoryController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[CategoryController::class,'changeStatus'])->name('status.change');


		Route::get('/{dataId}/edit',[CategoryController::class,'edit'])->name('edit');

		Route::post('/update',[CategoryController::class,'update'])->name('update');

		Route::post('/',[CategoryController::class,'store'])->name('store');

		Route::get('/create',[CategoryController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[CategoryController::class,'destroy'])->name('delete');

	});

	// for city
	Route::group(['prefix'=>'city','as'=>'city.'],function(){

		Route::get('/',[CityController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[CityController::class,'changeStatus'])->name('status.change');


		Route::get('/{dataId}/edit',[CityController::class,'edit'])->name('edit');

		Route::post('/update',[CityController::class,'update'])->name('update');

		Route::post('/',[CityController::class,'store'])->name('store');

		Route::get('/create',[CityController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[CityController::class,'destroy'])->name('delete');

	});

	// for country
	Route::group(['prefix'=>'country','as'=>'country.'],function(){

		Route::get('/',[CountryController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[CountryController::class,'changeStatus'])->name('status.change');

		Route::get('/{dataId}/edit',[CountryController::class,'edit'])->name('edit');

		Route::post('/update',[CountryController::class,'update'])->name('update');

		Route::post('/',[CountryController::class,'store'])->name('store');

		Route::get('/create',[CountryController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[CountryController::class,'destroy'])->name('delete');

	});


	// for garage types
	Route::group(['prefix'=>'garage/types','as'=>'garageType.'],function(){

		Route::get('/',[GarageTypeController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[GarageTypeController::class,'changeStatus'])->name('status.change');

		Route::get('/{dataId}/edit',[GarageTypeController::class,'edit'])->name('edit');

		Route::post('/update',[GarageTypeController::class,'update'])->name('update');

		Route::post('/',[GarageTypeController::class,'store'])->name('store');

		Route::get('/create',[GarageTypeController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[GarageTypeController::class,'destroy'])->name('delete');

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
	Route::group(['prefix'=>'resoproperty','as'=>'resoproperty.'],function(){

		Route::get('/',[ResoPropertyController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[ResoPropertyController::class,'changeStatus'])->name('status.change');
		
		Route::get('{dataId}/feature/{is_featured}/change',[ResoPropertyController::class,'changeFeature'])->name('feature.change');

		Route::get('/{dataId}/edit',[ResoPropertyController::class,'edit'])->name('edit');

		Route::post('/update',[ResoPropertyController::class,'update'])->name('update');

		Route::post('/',[ResoPropertyController::class,'store'])->name('store');

		Route::get('/create',[ResoPropertyController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[ResoPropertyController::class,'destroy'])->name('delete');	

	});

	// for properties types
	Route::group(['prefix'=>'property/types','as'=>'propertyType.'],function(){

		Route::get('/',[PropertyTypeController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[PropertyTypeController::class,'changeStatus'])->name('status.change');


		Route::get('/{dataId}/edit',[PropertyTypeController::class,'edit'])->name('edit');

		Route::post('/update',[PropertyTypeController::class,'update'])->name('update');

		Route::post('/',[PropertyTypeController::class,'store'])->name('store');

		Route::get('/create',[PropertyTypeController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[PropertyTypeController::class,'destroy'])->name('delete');	

	});

	// for sliders
	Route::group(['prefix'=>'slider','as'=>'slider.'],function(){

		Route::get('/',[SliderController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[SliderController::class,'changeStatus'])->name('status.change');

		Route::get('/{dataId}/edit',[SliderController::class,'edit'])->name('edit');

		Route::post('/update',[SliderController::class,'update'])->name('update');

		Route::post('/',[SliderController::class,'store'])->name('store');

		Route::get('/create',[SliderController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[SliderController::class,'destroy'])->name('delete');	
    
	});

// for state
	Route::group(['prefix'=>'state','as'=>'state.'],function(){

		Route::get('/',[StateController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[StateController::class,'changeStatus'])->name('status.change');

		Route::get('/{dataId}/edit',[StateController::class,'edit'])->name('edit');

		Route::post('/update',[StateController::class,'update'])->name('update');

		Route::post('/',[StateController::class,'store'])->name('store');

		Route::get('/create',[StateController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[StateController::class,'destroy'])->name('delete');	
    
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

	Route::group(['prefix'=>'marketActivity','as'=>'marketActivity.'],function(){

		Route::get('/',[MarketActivityController::class,'index'])->name('index');

		Route::get('{dataId}/status/{status}/change',[MarketActivityController::class,'changeStatus'])->name('status.change');

		Route::get('/{dataId}/edit',[MarketActivityController::class,'edit'])->name('edit');

		Route::post('/update',[MarketActivityController::class,'update'])->name('update');

		Route::post('/store',[MarketActivityController::class,'store'])->name('store');

		Route::get('/create',[MarketActivityController::class,'create'])->name('create');

		Route::delete('{dataId}/delete',[MarketActivityController::class,'destroy'])->name('delete');	
    
	});

	Route::group(['prefix'=>'help/desk','as'=>'helpDesk.'],function(){

		Route::get('/',[HelpDeskController::class,'index'])->name('index');
		
		Route::get('/messages',[HelpDeskController::class,'messages'])->name('messages');

		Route::post('/send/message',[HelpDeskController::class,'sendMessage'])->name('sendMessage');
	});

});	
