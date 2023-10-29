<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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


Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/{id}', [HomeController::class, 'showCubes'])->name('home');

Route::get('/cubes', [CubeController::class, 'index'])->name('cubes.index');
Route::get('/cubes/create', [CubeController::class, 'create'])->name('cubes.create');
Route::get('/cubes/{id}/edit', [CubeController::class, 'edit'])->name('cubes.edit');
Route::get('/cubes/{id}/showDetails', [CubeController::class, 'showDetail'])->name('cubes.showDetails');
Route::get('/cubes/{id}/editImage', [CubeController::class, 'editImage'])->name('cubes.editImage');
Route::post('/cubes/store', [CubeController::class, 'store'])->name('cubes.store');
Route::delete('/cubes/{id}', [CubeController::class, 'destroy'])->name('cubes.destroy');
Route::put('/cubes/update/{id}',[CubeController::class, 'update'])->name('cubes.update');
Route::put('/cubes/updateImage/{id}',[CubeController::class, 'updateImage'])->name('cubes.updateImage');

Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy');

Route::middleware(['auth'])->group(function(){
    Route::get('/users', [UserController::class, 'index'])->name('users.profile');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/usersList', [UserController::class, 'showUsers'])->name('users.usersList');
    Route::post('/users/enable/{id}',[UserController::class,'enableCube'])->name('enable');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

});


