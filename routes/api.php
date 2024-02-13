<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpresaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('empresa/count', [EmpresaController::class, 'count'])->name('empresa.count');
Route::get('cliente/count', [ClienteController::class, 'count'])->name('cliente.count');

Route::apiResource('cliente', ClienteController::class);
Route::apiResource('empresa', EmpresaController::class);
