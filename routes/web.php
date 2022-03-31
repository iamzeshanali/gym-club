<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//ROUTE: Login | Auth
Route::get('/login', function () {
    return view('auth/login');
})->name('login');

//ROUTE: Register | Auth
Route::get('/register', function () {
    return view('auth/register');
})->name('register');

//ROUTE: Forgot Password | Auth
Route::get('/forgot-password', function () {
    return view('auth/forgot-password');
})->name('forgot-password');


//GROUP: Dashboard Routes | NAME: dashboard. | PREFIX: dashboard/
Route::name('dashboard.')->group( function() {
    Route::prefix('dashboard')->group(function(){
        //    Route: Index
        Route::get('/', function () { return view('dashboard/main-page'); })->name('index');
        //    Route: Clubs
        Route::get('/clubs', function () { return view('dashboard/pages/clubs/clubs'); })->name('clubs');
    });

});
