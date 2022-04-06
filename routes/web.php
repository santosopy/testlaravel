<?php

use GuzzleHttp\Middleware;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix("admin")->namespace("App\Http\Controllers\Admin")->group(function(){

    // admin login
    Route::match(["get", "post"], 'login', "AdminController@login");

    // after login
    Route::group(["middleware"=>["admin"]], function(){

        // admin dashboard
        Route::get('dashboard', "AdminController@dashboard");
        
        // admin check password
        Route::post('check-admin-password', "AdminController@checkAdminPassword");

        // admin update password
        Route::match(["get", "post"], "update-admin-password", "AdminController@updateAdminPassword");

        // admin update details
        Route::match(["get","post"], "update-admin-details", "AdminController@updateAdminDetails");

        // vendor update details
        Route::match(["get","post"], "update-vendor-details/{slug}", "adminController@updateVendorDetails");

        // view admin vendors
        Route::get('admins/{type?}', "AdminController@admins");

        // detail view
        Route::get('admins/admins-vendor-details/{id}', "AdminController@adminsVendorDetails");

        // admin logout
        Route::get('logout', "AdminController@logout");
    });

});