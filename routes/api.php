<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/users/{user}', function (User $user) {
    $token = $user->createToken('token-name');
    return $token->plainTextToken;
});

/* Route::get('/login',function(){
    //
})->name('login'); */

Route::get('/user', function (){
    $valeurJson = ["clé" => "valeur"];
    return $valeurJson;
})->middleware('auth:sanctum');