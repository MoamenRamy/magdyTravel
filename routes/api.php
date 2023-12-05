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
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
Route::post('/reset-password', [NewPasswordController::class, 'store']);
Route::post('/user/confirm-password', [ConfirmablePasswordController::class, 'store']);




// Apply middleware in your API routes
// Route::middleware('auth:api')->get('/your-endpoint', 'YourController@index');



