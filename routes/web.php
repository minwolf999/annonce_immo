<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BaseController::class, 'home'])->name('home');
Route::get('/properties', [BaseController::class, 'properties'])->name('properties');
Route::post('/properties', [BaseController::class, 'filter_properties'])->name('filter_properties');

Route::get('/property/{appartment}', [BaseController::class, 'detail_property'])->name('detail_property');


Route::prefix('/')->name('auth.')->controller(AuthController::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::delete('/logout', 'logout')->name('logout');
    Route::post('/login', 'doLogin');
});


Route::prefix('/admin')->name('admin.')->middleware('auth')->controller(AdminController::class)->group(function() {
    Route::get('/property', 'property')->name('property');

    Route::get('/property/new', 'new_property')->name('new_property');
    Route::post('/property/new', 'create_property');

    Route::get('/property/modificate/{appartment}', 'modificate_property')->name('modificate_property');
    Route::patch('/property/modificate/{appartment}', 'property_modificate');
    Route::delete('/property/delete/{appartment}', 'delete_property')->name('delete_property');

    Route::get('/option', 'option')->name('option');

    Route::get('/option/new', 'new_option')->name('new_option');
    Route::post('/option/new', 'create_option');
    
    Route::get('/option/modificate/{options}', 'modificate_option')->name('modificate_option');
    Route::patch('/option/modificate/{options}', 'option_modificate');
    Route::delete('/option/delete/{options}', 'delete_option')->name('delete_option');

    Route::delete('/property/modificate/{appartment}/image/{image}', 'delete_image')->name('delete_image');
});
