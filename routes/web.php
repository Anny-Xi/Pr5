<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CubeController;
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

//Route::get('home/{name}', [HomeController::class,'index']);
Route::get('/', [WelcomeController::class,'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/cubes', [CubeController::class, 'index'])->name('cubes.index');
Route::get('/cubes/create', [CubeController::class, 'create'])->name('cubes.create');
Route::post('/cubes/store', [CubeController::class, 'store'])->name('cubes.store');
Route::delete('/cubes/{id}', [CubeController::class, 'destroy'])->name('cubes.destroy');

Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
