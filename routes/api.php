<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
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

Route::prefix('projects')->controller(ProjectsController::class)->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
});
Route::prefix('tasks')->controller(TasksController::class)->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::prefix('{taskId}')->group(function() {
        Route::get('/', 'show');
        Route::put('/updateByFields', 'updateByFields');
        Route::put('/updatePrioritiesByDragAndDrop', 'updatePrioritiesByDragAndDrop');
        Route::delete('/', 'destroy');
    });
});
