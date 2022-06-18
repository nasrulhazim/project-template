<?php


use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard > Teams
Breadcrumbs::for('teams.show', function (BreadcrumbTrail $trail, $team) {
    $trail->parent('dashboard');
    $trail->push('Team Details', route('teams.show', $team));
});

// Dashboard > Teams > Create
Breadcrumbs::for('teams.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Create New Team', route('teams.create'));
});
