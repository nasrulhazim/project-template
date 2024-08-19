<?php

use App\Contracts\Builder;
use App\Contracts\Menu;

it('runs on PHP 8.3 or above')
    ->expect(phpversion())
    ->toBeGreaterThanOrEqual('8.3.0');

it('does not use debugging functions')
    ->expect(['dd', 'dump', 'ray', 'var_dump', 'var_export'])
    ->not
    ->toBeUsed();

it('does not using url method')
    ->expect(['url'])
    ->not
    ->toBeUsed();

test('controllers')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller');

test('actions builder')
    ->expect('App\Actions\Builder')
    ->toImplement([Builder::class, Menu::class]);
