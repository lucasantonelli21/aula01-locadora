<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\RentController;
use App\Models\Customer;

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

Route::get('/', function () {
    return view('home');
});

Route::prefix('filmes')->name('movie.')->group(function () {

    Route::get('/',                                 [MovieController::class, 'index'])->name('home');
    Route::get('/criar',                            [MovieController::class, 'form'])->name('create');

    Route::get('{id}/editar',                       [MovieController::class, 'formEdit'])->name('formEdit');
    Route::post('/salvar',                          [MovieController::class, 'save'])->name('save');
    Route::delete('{id}/deletar',                   [MovieController::class, 'delete'])->name('delete');
    Route::put('{id}/editar',                       [MovieController::class, 'update'])->name('update');

    Route::prefix('/{id}')->name('rent.')->controller(RentController::class)->group(function () {

        Route::get('/alugar',  'form')->name('form');
        Route::post('/salvar', 'save')->name('save');

    });

});

Route::prefix('clientes')->name('customer.')->group(function () {

    Route::get('/',                                 [CustomerController::class, 'index'])->name('home');
    Route::get('/criar',                            [CustomerController::class, 'form'])->name('create');
    Route::get('{id}/editar',                       [CustomerController::class, 'formEdit'])->name('formEdit');
    Route::post('/salvar',                          [CustomerController::class, 'save'])->name('save');
    Route::delete('{id}/deletar',                   [CustomerController::class, 'delete'])->name('delete');
    Route::put('{id}/editar',                       [CustomerController::class, 'update'])->name('update');

    Route::prefix('/{id}')->name('rent.')->controller(RentController::class)->group(function () {
        Route::get('/',  'index')->name('home');
    });

});

// Route::prefix('alugar')->name('rent.')->group(function () {
//     Route::get('/{id}',                            [RentController::class, 'form'])->name('home');

// });
