<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FishingLogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FishingLogPageController;



/* Route::get('login', function (User $user) {
    $token = $user->createToken('token-name');
    return $token->plainTextToken;
}); */



/* Route::get('/login',function(){
    //
})->name('login'); */

/* Route::get('/user', function (){
    $valeurJson = ["clé" => "valeur"];
    return $valeurJson;
})->middleware('auth:sanctum'); */

Route::prefix('v1')->group(function () {

    // --- ROUTES PUBLIQUES (Si tu en as, par exemple l'inscription/connexion) ---
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',[AuthController::class, 'login']);


    // --- ROUTES PROTÉGÉES ---
    Route::middleware('auth:sanctum')->group(function () {
        
        // Toutes les routes à l'intérieur de ce groupe nécessitent un token valide
        
        // Users
        Route::apiResource('users', UserController::class)
            ->missing(function (Request $request) {
                return response()->json([
                    'message' => 'Désolé, cet utilisateur est introuvable ou a été supprimé.'
                ], 404);
        });
        
        Route::prefix('users/{userId}')->group(function () {
            Route::get('boats', [UserController::class, 'listUserBoats']);
            Route::get('trips', [UserController::class, 'listUserTrips']);
            Route::get('bookings', [UserController::class, 'listUserBookings']);
            
            Route::prefix('fishingLog')->group(function () {
                Route::apiResource('fishingLogPages', FishingLogPageController::class)->except(['show']);
            });
        });

        // Boats, Trips, Bookings
        Route::get('boats/searching-bbox', [BoatController::class, 'getAllBoatsInBoundingBox']);
        Route::apiResource('boats', BoatController::class)
        ->missing(function (Request $request) {
                return response()->json([
                    'message' => 'Désolé, ce bateau est introuvable ou a été supprimé.'
                ], 404);
        });
        Route::apiResource('trips', TripController::class)
        ->missing(function (Request $request) {
                return response()->json([
                    'message' => 'Désolé, ce bateau est introuvable ou a été supprimé.'
                ], 404);
        });
        Route::apiResource('bookings', BookingController::class)
        ->missing(function (Request $request) {
                return response()->json([
                    'message' => 'Désolé, ce bateau est introuvable ou a été supprimé.'
                ], 404);
        });
        
        Route::get('fishinglogs', [FishingLogController::class, 'index']);
    });
});