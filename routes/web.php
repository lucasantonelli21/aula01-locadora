<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyLogin;
use App\Http\Middleware\VerifyRole;
use App\Models\Customer;
use Illuminate\Foundation\Configuration\Middleware;

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



Route::prefix('usuarios')->name('user.')->group(function (){

    Route::get('/registrar',                         [UserController::class, 'formRegister'])->name('register');
    Route::post('/criar',                            [UserController::class, 'save'])->name('save');
    Route::post('/logar',                            [LoginController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout',                            [LoginController::class, 'logout'])->name('logout');
    Route::get('/perfil',                            [UserController::class, 'profile'])->middleware(VerifyLogin::class)->name('profile');
    Route::get('/perfil/editar',                     [UserController::class, 'getFormEdit'])->middleware(VerifyLogin::class)->name('formEdit');
    Route::put('/perfil/editar',                     [UserController::class, 'update'])->middleware(VerifyLogin::class)->name('update');
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(VerifyLogin::class)->get('/home', function () {
    return view('index');
})->name('loggedin');

Route::prefix('filmes')->middleware(VerifyLogin::class)->name('movie.')->group(function () {

    Route::get('/',                                 [MovieController::class, 'index'])->name('home');
    Route::get('/criar',                            [MovieController::class, 'form'])->middleware(VerifyRole::class)->name('create');
    Route::get('{id}/editar',                       [MovieController::class, 'formEdit'])->middleware(VerifyRole::class)->name('formEdit');
    Route::post('/salvar',                          [MovieController::class, 'save'])->middleware(VerifyRole::class)->name('save');
    Route::delete('{id}/deletar',                   [MovieController::class, 'delete'])->middleware(VerifyRole::class)->name('delete');
    Route::put('{id}/editar',                       [MovieController::class, 'update'])->middleware(VerifyRole::class)->name('update');

    Route::prefix('/{id}')->name('rent.')->controller(RentController::class)->group(function () {

        Route::get('/alugar',  'form')->name('form');
        Route::post('/salvar', 'save')->name('save');

    });

});


Route::prefix('clientes')->middleware(VerifyLogin::class)->name('customer.')->group(function () {

    Route::get('/',                                 [CustomerController::class, 'index'])->middleware(VerifyRole::class)->name('home');
    Route::get('/criar',                            [CustomerController::class, 'form'])->middleware(VerifyRole::class)->name('create');
    Route::get('{id}/editar',                       [CustomerController::class, 'formEdit'])->middleware(VerifyRole::class)->name('formEdit');
    Route::post('/salvar',                          [CustomerController::class, 'save'])->middleware(VerifyRole::class)->name('save');
    Route::delete('{id}/deletar',                   [CustomerController::class, 'delete'])->middleware(VerifyRole::class)->name('delete');
    Route::put('{id}/editar',                       [CustomerController::class, 'update'])->middleware(VerifyRole::class)->name('update');

    Route::prefix('/{id}')->name('rent.')->group(function ()  {
        Route::get('/aluguel',                              [RentController::class, 'index'])->name('home');
        Route::get('/aluguel/editar/{rentId}',              [RentController::class, 'formEdit'])->name('formEdit');
        Route::delete('/aluguel/deletar/{rentId}',          [RentController::class, 'delete'])->middleware(VerifyRole::class)->name('delete');
        Route::put('/aluguel/editar/{rentId}',              [RentController::class, 'update'])->name('update');
    });

});

// Route::prefix('alugar')->name('rent.')->group(function () {
//     Route::get('/{id}',                            [RentController::class, 'form'])->name('home');

// });
