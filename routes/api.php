<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Verify email

Route::post('register',[
    \App\Http\Controllers\AuthController::class,
    'register'
]);

Route::post('login',[
    \App\Http\Controllers\AuthController::class,
    'login'
]);

Route::get('alluser',[
    \App\Http\Controllers\AuthController::class,
    'alluser'
]);


Route::middleware('auth:sanctum')->group(function (){
    Route::get('user',[
        \App\Http\Controllers\AuthController::class,
        'user'
    ]);
    Route::post('logout',[
        \App\Http\Controllers\AuthController::class,
        'logout'
    ]);

    Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

    // Resend link to verify email
    Route::post('/email/verify/resend', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

});



Route::resource('/category','CategoryController');
Route::resource('/post','PostController');