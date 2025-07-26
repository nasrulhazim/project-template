<?php

it('runs on PHP 8.4 or above')
    ->expect(phpversion())
    ->toBeGreaterThanOrEqual('8.4.0');

arch()
    ->expect(['dd', 'dump', 'ray'])
    ->not
    ->toBeUsedIn([
        'app',
        'config',
        'database',
        'routes',
        'support',
    ]);

it('does not using url method')
    ->expect(['url'])
    ->not
    ->toBeUsed();

// Controllers must end with Controller
arch()
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller');

// Policies must be in App\Policies
arch()
    ->expect('App\Policies')
    ->toBeClasses();

arch()
    ->expect('App\Policies')
    ->toHaveSuffix('Policy');

// Mails must be in App\Mail
arch()
    ->expect('App\Mail')
    ->toBeClasses();

arch()
    ->expect('App\Mail')
    ->toExtend('Illuminate\Mail\Mailable');

arch()
    ->expect('env')
    ->toOnlyBeUsedIn([
        'config',
    ]);

arch()
    ->expect('App')
    ->not
    ->toUse([
        'DB::raw',
        'DB::select',
        'DB::statement',
        'DB::table',
        'DB::raw',
        'DB::select',
        'DB::insert',
        'DB::update',
        'DB::delete',
    ]);

arch()
    ->expect('App\Concerns')
    ->toBeTraits();

arch()
    ->expect('App\Enums')
    ->toBeEnums();

arch()
    ->expect('App\Contracts')
    ->toBeInterfaces();
