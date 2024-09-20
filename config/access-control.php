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
            'module' => 'General',
            'functions' => [
                'administration' => ['view', 'update'],
                'security' => ['view', 'update'],
                'settings' => ['view', 'update'],
                'impersonate' => ['view', 'create', 'update'],
            ],
        ],
        [
            'module' => 'Security',
            'functions' => [
                'access-control' => ['view', 'create', 'update', 'delete'],
                'role' => ['view', 'create', 'update', 'delete'],
                'user' => ['view', 'create', 'update', 'delete'],
                'issues' => ['view', 'update'],
                'queues' => ['view', 'update'],
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

        /** General */
        'update-administration-general' => ['superadmin'],
        'view-administration-general' => ['superadmin'],
        'update-security-general' => ['superadmin'],
        'view-security-general' => ['superadmin'],
        'update-settings-general' => ['superadmin'],
        'view-settings-general' => ['superadmin'],
        'view-impersonate-general' => ['superadmin'],
        'create-impersonate-general' => ['superadmin'],
        'update-impersonate-general' => ['superadmin'],

        /** Security */
        'view-access-control-security' => ['superadmin'],
        'create-access-control-security' => ['superadmin'],
        'update-access-control-security' => ['superadmin'],
        'delete-access-control-security' => ['superadmin'],
        'view-role-security' => ['superadmin'],
        'create-role-security' => ['superadmin'],
        'update-role-security' => ['superadmin'],
        'delete-role-security' => ['superadmin'],
        'view-user-security' => ['superadmin'],
        'create-user-security' => ['superadmin'],
        'update-user-security' => ['superadmin'],
        'delete-user-security' => ['superadmin'],
        'view-issues-security' => ['superadmin'],
        'update-issues-security' => ['superadmin'],
        'view-queues-security' => ['superadmin'],
        'update-queues-security' => ['superadmin'],
        'view-audit-security' => ['superadmin'],

        /** Dashboard */
        'view-user-dashboard' => ['superadmin'],
        'view-administrator-dashboard' => ['superadmin'],
    ],
];
