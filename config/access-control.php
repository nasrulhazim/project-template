<?php

return [

    'enabled' => env('ACCESS_CONTROL_ENABLED', true),

    'roles' => [
        'superadmin' => 'Dictactor',
        'administrator' => 'Play a role in working with administration works.',
        'user' => 'Default user role that able to create event, participate in events, etc.',
    ],

    'permissions' => [
        [
            'module' => 'Administration',
            'functions' => [
                'role' => ['view', 'create', 'update', 'delete'],
                'user' => ['view', 'create', 'update', 'delete'],
                'audit' => ['view'],
            ],
        ],
        [
            'module' => 'Dashboard',
            'functions' => [
                'user' => ['view'],
                'administrator' => ['view'],
            ],
        ],
    ],

    'roles_permissions' => [

        /** Administration */
        'view-role-administration' => ['superadmin'],
        'create-role-administration' => ['superadmin'],
        'update-role-administration' => ['superadmin'],
        'delete-role-administration' => ['superadmin'],
        'view-user-administration' => ['superadmin', 'administrator'],
        'create-user-administration' => ['superadmin', 'administrator'],
        'update-user-administration' => ['superadmin', 'administrator'],
        'delete-user-administration' => ['superadmin'],
        'view-audit-administration' => ['superadmin'],

        /** Dashboard */
        'view-user-dashboard' => ['user'],
        'view-administrator-dashboard' => ['superadmin', 'administrator'],

        /** Generic Permissions */
        'update-settings' => ['superadmin', 'administrator'],
        'update-administration' => ['superadmin', 'administrator'],
        'impersonate' => ['superadmin', 'administrator'],
        'manage-api-token' => ['superadmin', 'administrator'],
        'view-telescope' => ['superadmin'],
        'view-horizon' => ['superadmin'],
        'view-admin' => ['superadmin'],
        'view-access-control' => ['superadmin', 'administrator'],
        'update-access-control' => ['superadmin', 'administrator'],
        'create-access-control' => ['superadmin', 'administrator'],
        'delete-access-control' => ['superadmin', 'administrator'],
    ],

    'generic_permissions' => [
        'update-settings', 'update-administration', 'impersonate', 'manage-api-token',
        'view-telescope', 'view-horizon', 'view-admin',
        'view-access-control', 'update-access-control', 'create-access-control', 'delete-access-control',
    ],
];
