<?php

return [
    'roles' => [
        'superadmin',
        'administrator',
        'user',
    ],

    'roles_permissions' => [

        'view-user' => [
            'superadmin', 'administrator',
        ],

        'create-user' => [
            'superadmin', 'administrator',
        ],

        'update-user' => [
            'superadmin', 'administrator', 'user',
        ],

        'delete-user' => [
            'superadmin',
        ],
    ],
];
