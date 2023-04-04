<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\ResoApiPropertyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get( '/index', [PropertyController::class,'index'])->name('property.index');
Route::get( '/store', [ResoApiPropertyController::class,'store'])->name('api.property.store');
// Route::get('/get-data',[PropertyController::class,'index'])->name('property.index');

