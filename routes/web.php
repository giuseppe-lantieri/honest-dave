<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ItemController;
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



Route::get('/register', [AuthController::class, "register"])->name("register");
Route::post('/register', [AuthController::class, "store"]);

Route::get('/collections/{collection}', [CollectionController::class, "show"])->name("collections.show");
Route::post('/collections', [CollectionController::class, "store"])->name("collections.store");

Route::get('/login', [AuthController::class, "login"])->name("login");
Route::post('/login', [AuthController::class, "autheticate"]);
Route::post('/logout', [AuthController::class, "logout"])->name('logout');


Route::get('/', [CollectionController::class, "index"])->name("home");
