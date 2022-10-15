<?php

// config for Bekwoh/LaravelDbDoc

use Bekwoh\LaravelDbDoc\Presentation\Json;
use Bekwoh\LaravelDbDoc\Presentation\Markdown;

return [
    'format' => 'markdown',
    'presentations' => [
        'markdown' => [
            'class' => Markdown::class,
            'disk' => env('LARAVEL_DB_DOC_MARKDOWN_DISK', 'local'),
            'view' => 'db-doc::markdown',
        ],
        'json' => [
            'class' => Json::class,
            'disk' => env('LARAVEL_DB_DOC_JSON_DISK', 'local'),
            'view' => null,
        ],
    ],
    'middleware' => [
        'auth:sanctum',
    ],
];
