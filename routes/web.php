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

Route::get('/home', function () {
    return view('home.home');
});

//Authentication
Route::get('/', function () {
    return view('login.login');
});
Route::post('/user/login', [UserController::class, 'user_login']);
Route::get('/user/logout', [UserController::class, 'user_logout']);

Route::get('/register', function () {
    return view('registration.register');
});
