<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector;
use Rector\Config\RectorConfig;
use RectorLaravel\Set\LaravelLevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/support',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->skip([
        SimplifyIfReturnBoolRector::class,
    ]);

    // Apply Laravel-specific rules up to the desired version
    $rectorConfig->sets([
        LaravelLevelSetList::UP_TO_LARAVEL_110,
        SetList::CODE_QUALITY,
    ]);
};
