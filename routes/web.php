<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProductoController;
use App\Http\Controllers\Admin\AdminProveedorController;

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

/* Navigation Menu Pages */
Route::get('/about', function () {
    return Inertia::render('AboutUs');
})->name('aboutus');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    /* Route::group(['middleware' => ['role:admin']], function () {
        Route::name('admin.')->group(function (){
            Route::resource('productos', App\Http\Controllers\Admin\AdminProductoController::class);
        });
    }); */

    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::resource('productos', App\Http\Controllers\Admin\AdminProductoController::class);
            Route::resource('proveedores', App\Http\Controllers\Admin\AdminProveedorController::class);
        });
});
