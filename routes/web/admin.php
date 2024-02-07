<?php

use App\Http\Controllers\Administration\AccessControlController;
use App\Http\Controllers\Administration\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('can:view-admin')->as('admin.')->prefix('admin')->group(function () {
    Route::get('access-control', [AccessControlController::class, 'index'])->name('access-control.index');
    Route::get('access-control/{uuid}', [AccessControlController::class, 'show'])->name('access-control.show');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{uuid}', [UserController::class, 'show'])->name('users.show');
});
