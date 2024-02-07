<?php

use App\Http\Controllers\Administration\AccessControlController;
use Illuminate\Support\Facades\Route;

Route::middleware('can:view-admin')->as('admin.')->prefix('admin')->group(function () {
    Route::get('access-control', [AccessControlController::class, 'index'])->name('access-control.index');
    Route::get('access-control/{uuid}', [AccessControlController::class, 'show'])->name('access-control.show');
});
