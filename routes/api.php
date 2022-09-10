<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('graphs', [\App\Http\Controllers\Api\GraphController::class, 'index'])->name('graph.index');
Route::post('graph', [\App\Http\Controllers\Api\GraphController::class, 'store'])->name('graph.store');
Route::post('graph/update/{graph}', [\App\Http\Controllers\Api\GraphController::class, 'update'])->name('graph.update');
Route::delete('graph/delete/{graph}', [App\Http\Controllers\Api\GraphController::class, 'delete'])->name('graph.delete'); 
