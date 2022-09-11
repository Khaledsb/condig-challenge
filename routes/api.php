<?php

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
Route::group(['prefix'=>'graph','as'=>'graph.'], function(){
    Route::get('/', [\App\Http\Controllers\Api\GraphController::class, 'index'])->name('index');
    Route::post('/', [\App\Http\Controllers\Api\GraphController::class, 'store'])->name('store');
    Route::post('/update/{graph}', [\App\Http\Controllers\Api\GraphController::class, 'update'])->name('update');
    Route::delete('/delete/{graph}', [App\Http\Controllers\Api\GraphController::class, 'delete'])->name('delete');
    Route::get('/show/{graph}', [\App\Http\Controllers\Api\GraphController::class, 'show'])->name('show');
});

Route::group(['prefix'=>'node','as'=>'node.'], function(){
    Route::post('/{node}/add-relation-with', [\App\Http\Controllers\Api\NodeController::class, 'addRelation'])->name('add-relation');
    Route::post('/add-node-to-graph', [\App\Http\Controllers\Api\NodeController::class, 'addToGraph'])->name('add-to-graph');
    Route::delete('/delete/{node}', [App\Http\Controllers\Api\NodeController::class, 'delete'])->name('delete');
});
