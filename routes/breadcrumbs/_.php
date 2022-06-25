<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > Users
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.index'));
});

// Profile
Breadcrumbs::for('profile.show', function (BreadcrumbTrail $trail) {
    $trail->push('Profile', route('profile.show'));
});

// API Token
Breadcrumbs::for('api-tokens.index', function (BreadcrumbTrail $trail) {
    $trail->push('API Tokens', route('api-tokens.index'));
});

// Notifications
Breadcrumbs::for('notifications', function (BreadcrumbTrail $trail) {
    $trail->push('Notifications', route('notifications'));
});
