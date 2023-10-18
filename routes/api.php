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
        Route::post('register',         'register'  );
        Route::post('login',            'login'     );
        Route::post('forgot_password',  'forgotPass');
        Route::post('reset_password',   'resetPass' );
        Route::post('check_user',       'checkUser' );
    });
});

Route::middleware('auth:sanctum')->namespace('\App\Http\Controllers\API')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Auth Route
    |--------------------------------------------------------------------------
    */
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::get('view',          'view'     );
        Route::post('update',       'update'   );
        Route::get('logout',        'logout'   );
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
        Route::get('list',              'index'  );
        Route::get('show/{id}',         'show'   );
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
    });
});