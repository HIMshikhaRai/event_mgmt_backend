<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/events', [EventApiController::class, 'getAllEvents']);
Route::get('/events/{address}', [EventApiController::class, 'getEventsByAddress']);
Route::get('/events/{address}/startDate/{startDate}/endDate/{endDate}', [EventApiController::class, 'filterEventsByAddressDate']);
