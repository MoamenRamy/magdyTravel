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

Route::prefix('/users')->group(function()
{
    Route::apiResource('/', UserController::class)->parameters([
        '' => 'user',
    ]);
    Route::patch('/adminSet/{id}', [UserController::class, 'changeRoleToAdmin']);
    Route::patch('/superAdminSet/{id}', [UserController::class, 'changeRoleToSuperAdmin']);
    Route::patch('/defaultUser/{id}', [UserController::class, 'changeRoleToDefualtUser']);
});
Route::redirect('user', 'users');

Route::prefix('/travels')->group(function()
{
    Route::apiResource('/', TravelController::class)->parameters([
        '' => 'travel',
    ]);
    Route::get('/by-category/{categorySlug}', [TravelController::class, 'getByCategorySlug']);
});
Route::redirect('travel', 'travels');

Route::apiResource('/destinations', DestinationController::class);
Route::redirect('destination', 'destinations');

Route::apiResource('/rides', RideController::class);
Route::redirect('ride', 'rides');

Route::apiResource('/categories', CategoryController::class);
Route::redirect('category', 'categories');

Route::apiResource('/reviews', ReviewController::class);
Route::redirect('review', 'reviews');

Route::apiResource('/currencies', CurrencyController::class);
Route::redirect('currency', 'currencies');

Route::apiResource('/booking/travels', UserTravelController::class);

Route::prefix('/trips')->group(function()
{
    Route::post('/price/change', [ChangeTripPriceController::class, 'store']);
    Route::apiResource('/', TripController::class)->parameters([
        '' => 'trip',
    ]);
});
Route::redirect('trip', 'trips');


// Apply middleware in your API routes
// Route::middleware('auth:api')->get('/your-endpoint', 'YourController@index');



