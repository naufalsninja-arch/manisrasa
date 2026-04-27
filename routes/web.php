<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminMenuController;

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', function () {
    return view('home');
});

// MENU USER
Route::get('/menu', [MenuController::class, 'index']);

// ABOUT
Route::get('/about', function () {
    return view('about');
});

// CONTACT
Route::get('/contact', function () {
    return view('contact');
});

// ORDER USER
Route::get('/order', [OrderController::class, 'index']);
Route::post('/order/store', [OrderController::class, 'store']);

Route::get('/cek-order', [OrderController::class, 'cekOrder']);
Route::post('/cek-order', [OrderController::class, 'cariOrder']);


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    /*
    |--------------------------
    | AUTH ADMIN (PUBLIC)
    |--------------------------
    */

    Route::get('/login', [AdminAuthController::class, 'loginPage']);
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::get('/logout', [AdminAuthController::class, 'logout']);


    /*
    |--------------------------
    | ADMIN PROTECTED ROUTES
    |--------------------------
    */

    Route::middleware('admin')->group(function () {

        // DASHBOARD
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });

        // MENU CRUD
        Route::get('/menu', [AdminMenuController::class, 'index']);
        Route::post('/menu/store', [AdminMenuController::class, 'store']);
        Route::post('/menu/update/{id}', [AdminMenuController::class, 'update']);
        Route::get('/menu/delete/{id}', [AdminMenuController::class, 'destroy']);

        // ORDER ADMIN
        Route::get('/order', [OrderController::class, 'adminIndex']);
        Route::post('/order/update-status/{id}', [OrderController::class, 'updateStatus']);
    });

});