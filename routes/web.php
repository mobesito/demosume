<?php

use App\Http\Controllers\UsuarioController;
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

Route::get('/', [UsuarioController::class, 'index']);
Route::post('/', [UsuarioController::class, 'store'])->name('usuario.store');
Route::patch('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');


