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

Route::namespace('App\Http\Controllers\API')->group(function() {
    /*
    |--------------------------------------------------------------------------
    | Auth Route
    |--------------------------------------------------------------------------
    */
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::post('register',         'register'     );
        Route::post('login',            'login'        );
        Route::post('account_varify',   'accountVarify');
        Route::post('forgot_password',  'forgotPass'   );
        Route::post('verify_otp',       'verifiOtp'    );
        Route::post('resend_otp',       'resendOtp'    );
        Route::post('reset_password',   'resetPass'    );
        Route::post('check_user',       'checkUser'    );
    });
});

Route::middleware('subscription.api')->namespace('\App\Http\Controllers\API')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Subscription Route
    |--------------------------------------------------------------------------
    */
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::post('subscription',      'subscription');
    });
});
Route::middleware('auth:sanctum')->namespace('\App\Http\Controllers\API')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Auth Route
    |--------------------------------------------------------------------------
    */
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::get('view',              'view'   );
        Route::post('update',           'update' );
        Route::get('logout',            'logout' );
        Route::delete('delete/{id}',    'destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Packagings Route
    |--------------------------------------------------------------------------
    */
    Route::controller(PackagingController::class)->prefix('packagings')->group(function () {
        Route::get('list',                  'index'  );
        Route::post('store',                'store'  );
        Route::patch('update/{packaging}',  'update' );
        Route::delete('delete/{id}',        'destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Cosignees Route
    |--------------------------------------------------------------------------
    */
    Route::controller(ConsigneeController::class)->prefix('consignees')->group(function () {
        Route::get('list',                  'index'  );
        Route::post('store',                'store'  );
        Route::patch('update/{consignee}',  'update' );
        Route::delete('delete/{id}',        'destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Chemicals Route
    |--------------------------------------------------------------------------
    */
    Route::controller(ChemicalController::class)->prefix('chemicals')->group(function () {
        Route::get('list',                  'index'  );
        Route::get('show/{id}',             'show'   );
        Route::patch('update/{chemical}',   'update' );
    });

    /*
    |--------------------------------------------------------------------------
    | Invoices Route
    |--------------------------------------------------------------------------
    */
    Route::controller(InvoiceController::class)->prefix('invoices')->group(function () {
        Route::get('list',                'index'     );
        Route::get('show/{id}',           'show'      );
        Route::post('store',              'store'     );
        Route::patch('update/{invoice}',  'update'    );
        Route::delete('delete/{id}',      'destroy'   );
        Route::get('check-limit',         'checkLimit');
        Route::post('upload',             'upload'    );
    });

    /*
    |--------------------------------------------------------------------------
    | Bookmarks Route
    |--------------------------------------------------------------------------
    */
    Route::controller(BookmarkController::class)->prefix('bookmarks')->group(function () {
        Route::get('list',                'index'     );
        Route::post('store',              'store'     );
        Route::delete('delete/{id}',      'destroy'   );
    });
});