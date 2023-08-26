<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TutorialController;
use App\Models\Menu;
use App\Models\Tutorial;

//route resource
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
    return view('welcome');
});
Route::resource('/menus', \App\Http\Controllers\MenuController::class);
Route::resource('/tutorials', \App\Http\Controllers\TutorialController::class);
Route::get('/tutoradd', [TutorialController::class, 'create'])->name('create');
Route::post('/tutorstore', [TutorialController::class, 'store'])->name('store');

