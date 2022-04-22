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

//ROUTE: Register, Login, Logout | Auth
Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register'])->name('user.register');
Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('user.login');
Route::get('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('user.logout');

//ROUTE: Forgot Password | Auth
Route::get('/forgot-password', function () {
    return view('auth/forgot-password');
})->name('forgot-password');


//GROUP: Dashboard Routes | NAME: dashboard. | PREFIX: dashboard/

Route::middleware('auth')->group( function(){
    //GROUP: Dashboard Routes | NAME: dashboard. | PREFIX: dashboard/
    Route::name('dashboard.')->group( function() {
        Route::prefix('dashboard')->group(function(){
            //    Route: Index
            Route::get('/', function () { return view('dashboard/main-page'); })->name('index');
            //    Route: Clubs
            Route::resource('roles',\App\Http\Controllers\RoleController::class);

            Route::resource('users',\App\Http\Controllers\UsersController::class);

            Route::resource('clubs',\App\Http\Controllers\ClubsController::class);

            Route::get('/change-clubs/{id}', [\App\Http\Controllers\ClubsController::class,'changeClub'])->name('changeClub');

            Route::resource('user-clubs-config',\App\Http\Controllers\UsersClubsConfigController::class);

            Route::resource('subscriptions',\App\Http\Controllers\SubscriptionController::class);

            Route::resource('activities',\App\Http\Controllers\ActivityController::class);

            Route::resource('addons',\App\Http\Controllers\AddOnController::class);

            Route::resource('memberships',\App\Http\Controllers\MembershipController::class);

            Route::resource('inquiries',\App\Http\Controllers\InquiryController::class);

            Route::resource('members',\App\Http\Controllers\MemberController::class);

            Route::resource('timelogs',\App\Http\Controllers\TimelogController::class);
        });
    });
});


