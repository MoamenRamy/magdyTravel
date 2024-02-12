<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\DestinationController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ChangeTripPriceController;
use App\Http\Controllers\api\CurrencyController;
use App\Http\Controllers\api\PhotoController;
use App\Http\Controllers\api\ReviewController;
use App\Http\Controllers\api\RideController;
use App\Http\Controllers\api\TravelController;
use App\Http\Controllers\api\TripController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\UserTravelController;
use App\Http\Controllers\Auth\ApiAuthController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::prefix('/users')->group(function()
// {
//     Route::apiResource('/', UserController::class)->parameters([
//         '' => 'user',
//     ]);
//     Route::patch('/adminSet/{id}', [UserController::class, 'changeRoleToAdmin']);
//     Route::patch('/superAdminSet/{id}', [UserController::class, 'changeRoleToSuperAdmin']);
//     Route::patch('/defaultUser/{id}', [UserController::class, 'changeRoleToDefualtUser']);
//     Route::post('/update-profile', [UserController::class, 'updateProfile']);
// });

Route::apiResource('/users', UserController::class);
Route::patch('users/adminSet/{id}', [UserController::class, 'changeRoleToAdmin']);
Route::patch('users/superAdminSet/{id}', [UserController::class, 'changeRoleToSuperAdmin']);
Route::patch('users/defaultUser/{id}', [UserController::class, 'changeRoleToDefualtUser']);
Route::post('users/update-profile', [UserController::class, 'updateProfile']);
Route::redirect('user', 'users');

// Route::prefix('/travels')->group(function()
// {
//     Route::apiResource('/', TravelController::class)->parameters([
//         '' => 'travel',
//     ]);
//     Route::get('/by-category/{categorySlug}', [TravelController::class, 'getByCategorySlug']);
//     Route::post('/{id}/addPhotos', [TravelController::class, 'addPhotos']);
// });

Route::apiResource('/travels', TravelController::class);
Route::get('travel/all', [TravelController::class, 'indexAll']);
Route::get('travels/by-category/{categorySlug}', [TravelController::class, 'getByCategorySlug']);
Route::post('travels/{id}/addPhotos', [TravelController::class, 'addPhotos']);
Route::delete('travels/photos/{id}', [PhotoController::class, 'deletePhoto']);
Route::redirect('travel', 'travels');

Route::apiResource('/destinations', DestinationController::class);
Route::get('/destination/all', [DestinationController::class, 'indexAll']);
Route::redirect('destination', 'destinations');

Route::apiResource('/rides', RideController::class);
Route::redirect('ride', 'rides');

Route::apiResource('/categories', CategoryController::class);
// Route::patch('/categoriesUpdate/{id}', [CategoryController::class, 'updateCategoryPhoto']);
Route::redirect('category', 'categories');

Route::apiResource('/reviews', ReviewController::class);
Route::redirect('review', 'reviews');

Route::apiResource('/currencies', CurrencyController::class);
Route::redirect('currency', 'currencies');

Route::apiResource('/booking/travel', UserTravelController::class);

// Route::prefix('/trips')->group(function()
// {
//     Route::post('/price/change', [ChangeTripPriceController::class, 'store']);
//     Route::get('/price/show', [ChangeTripPriceController::class, 'showLastPrice']);
//     Route::apiResource('/', TripController::class)->parameters([
//         '' => 'trip',
//     ]);
// });
Route::apiResource('/trips', TripController::class);
Route::post('trips/price/change', [ChangeTripPriceController::class, 'store']);
Route::get('trips/price/show', [ChangeTripPriceController::class, 'showLastPrice']);
Route::redirect('trip', 'trips');

Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);
// Route::post('/confirm-password', [ApiAuthController::class, 'confirmPassword']);
// Route::post('/forgot-password', [ApiAuthController::class, 'forgotPassword']);
// Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:api');

// require __DIR__.'/auth.php';

// Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('auth:sanctum');


