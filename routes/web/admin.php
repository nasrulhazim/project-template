<?php

use App\Http\Controllers\Administration\AccessControlController;
use App\Http\Controllers\Administration\AuditTrailController;
use App\Http\Controllers\Administration\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('can:view-admin')->as('admin.')->prefix('admin')->group(function () {
    // Access Control
    Route::get('access-control', [AccessControlController::class, 'index'])
        ->name('access-control.index');
    Route::get('access-control/{uuid}', [AccessControlController::class, 'show'])
        ->name('access-control.show');

    // User Management
    Route::get('users', [UserController::class, 'index'])
        ->name('users.index');
    Route::get('users/{uuid}', [UserController::class, 'show'])
        ->name('users.show');

    // Audit Trail
    Route::get('audit-trail', [AuditTrailController::class, 'index'])
        ->name('audit-trail.index');
    Route::get('audit-trail/{uuid}', [AuditTrailController::class, 'show'])
        ->name('audit-trail.show');
});
