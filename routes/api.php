<?php

use App\Http\Controllers as Controllers;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'api.',
    'prefix' => '/api',
], function () {
    Route::group(['prefix' => '/tasks'], function () {
        Route::get('', [Controllers\TaskController::class, 'index'])->name('tasks.list');
        Route::post('', [Controllers\TaskController::class, 'create'])->name('tasks.create');
        Route::get('/{task}', [Controllers\TaskController::class, 'show'])->name('tasks.show');
        Route::put('/{task}', [Controllers\TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/{task}', [Controllers\TaskController::class, 'delete'])->name('tasks.delete');
    });
});
