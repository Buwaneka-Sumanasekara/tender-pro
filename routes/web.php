<?php
use App\Http\Controllers\UserController;
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

Route::get('/',[UserController::class, 'home']);

/*==User Login / Registration===*/
Route::post('/user/login', [UserController::class, 'user_login']);
Route::get('/user/logout', [UserController::class, 'user_logout']);
Route::post('/user/register', [UserController::class, 'user_registration']);
Route::put('/profile/update', [UserController::class, 'user_update_profile']);
Route::post('/profile/change-password', [UserController::class, 'user_change_password']);

Route::get('/login', function () {
    return view('login.login');
});

Route::get('/register', function () {
    return view('registration.register');
});

/*==END: User Login / Registration===*/
