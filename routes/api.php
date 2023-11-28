<?php

use App\Http\Controllers\api\DestinationController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ChangeTripPriceController;
use App\Http\Controllers\api\CurrencyController;
use App\Http\Controllers\api\ReviewController;
use App\Http\Controllers\api\RideController;
use App\Http\Controllers\api\TravelController;
use App\Http\Controllers\api\TripController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\UserTravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/users', UserController::class);
Route::patch('users/changeCurrency/{id}', [UserController::class, 'changeCurrency']);

Route::apiResource('/travels', TravelController::class);

Route::apiResource('/destinations', DestinationController::class);

Route::apiResource('/rides', RideController::class);

Route::apiResource('/categories', CategoryController::class);

Route::apiResource('/reviews', ReviewController::class);

Route::apiResource('/currencies', CurrencyController::class);
Route::get('/change', [CurrencyController::class, 'change']);

Route::apiResource('/booking/travels', UserTravelController::class);

Route::post('/trips/price/change', [ChangeTripPriceController::class, 'store']);

Route::apiResource('/trip', TripController::class);

// Apply middleware in your API routes
// Route::middleware('auth:api')->get('/your-endpoint', 'YourController@index');



