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

Route::view('/login','auth/login')->name('login');
Route::view('/register','auth/register')->name('register');

//ROUTE: Register | Auth
Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register'])->name('user.register');
Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('user.login');



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

        Route::resource('roles',\App\Http\Controllers\RoleController::class);

        Route::resource('users',\App\Http\Controllers\UsersController::class);

        Route::resource('clubs',\App\Http\Controllers\ClubsController::class);
    });

});
