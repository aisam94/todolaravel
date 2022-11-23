<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
//     // view argument based on views folder file name
// });

// Todo routes
Route::get('/', [TodoController::class, 'index']);
Route::get('create', [TodoController::class, 'create']);
Route::get('details/{todo}', [TodoController::class, 'details']);
Route::get('edit/{todo}', [TodoController::class, 'edit']);
Route::post('update/{todo}', [TodoController::class, 'update']);
Route::get('delete/{todo}', [TodoController::class, 'delete']);

// Auth routes
Route::get('dashboard', [AuthController::class, 'dashboard']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');

Route::get('register', [AuthController::class, 'register'])->name('register-user');
Route::post('custom-register', [AuthController::class, 'customRegister'])->name('register.custom');

Route::get('signout', [AuthController::class, 'signOut'])->name('signout');


// sending data to server
Route::post('store-data', [TodoController::class, 'store']);
