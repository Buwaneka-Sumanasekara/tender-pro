<?php
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TenderController;
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

Route::get('/', [UserController::class, 'show_home']);

/*==User Login / Registration===*/
Route::post('/user-actions/login', [UserController::class, 'user_login']);
Route::get('/user-actions/logout', [UserController::class, 'user_logout']);
Route::post('/user-actions/register', [UserController::class, 'user_registration']);
Route::put('/user-actions/profile/update', [UserController::class, 'user_update_profile']);
Route::post('/user-actions/profile/change-password', [UserController::class, 'user_change_password']);

Route::get('/login', function () {
    return view('login.login');
})->middleware('user.session.validate');

Route::get('/register', function () {
    return view('registration.register');
})->middleware('user.session.validate');

/*=== Account   ===*/
Route::get('/account', [AccountController::class, 'account_show_dashboard']);

Route::prefix('account')->group(function () {
    Route::get('/', [AccountController::class, 'account_show_dashboard']);
    Route::prefix('tender')->group(function () {
        Route::get('/new', [TenderController::class, 'account_show_create_tender']);
        Route::prefix('categorries')->group(function () {
            Route::get('/', [TenderController::class, 'account_show_categorries']);
            Route::get('/new', [TenderController::class, 'account_show_create_category']);
            Route::get('/edit/{categoryId}', [TenderController::class, 'account_show_edit_category']);
        });
        Route::prefix('drafts')->group(function () {
            Route::get('/', [TenderController::class, 'account_show_draft_tenders']);
            Route::get('/edit/{tenderId}', [TenderController::class, 'account_show_edit_draft_tenders']);

        });

    });
});

/*==Tender create/update/List===*/
Route::post('/tender-actions/create', [TenderController::class, 'createTender']);
Route::post('/tender-actions/update', [TenderController::class, 'updateTender']);
Route::post('/tender-actions/category/create', [TenderController::class, 'createTenderCategory']);
Route::get('/tender-actions/category/delete/{id}', [TenderController::class, 'deleteTenderCategory']);
Route::post('/tender-actions/category/update', [TenderController::class, 'updateTenderCategory']);
