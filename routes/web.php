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
Route::get('/collections/other/{collection}', [CollectionController::class, "other"])->name("collections.other");
Route::delete('/collections/{collection}', [CollectionController::class, "destroy"])->name("collections.destroy");
Route::post('/collections', [CollectionController::class, "store"])->name("collections.store");
Route::post('/collections/{collection}/favorite', [CollectionController::class, "favorite"])->name("collections.favorite");
Route::post('/collections/{collection}/unfavorite', [CollectionController::class, "unfavorite"])->name("collections.unfavorite");

Route::get('/login', [AuthController::class, "login"])->name("login");
Route::post('/login', [AuthController::class, "autheticate"]);
Route::post('/logout', [AuthController::class, "logout"])->name('logout');

Route::delete('/items/{item}', [ItemController::class, "destroy"])->name("items.destroy");
Route::post('/items/{item}/like', [ItemController::class, "like"])->name("items.like");
Route::post('/items/{item}/unlike', [ItemController::class, "unlike"])->name("items.unlike");

Route::get('/', [CollectionController::class, "index"])->name("home");
