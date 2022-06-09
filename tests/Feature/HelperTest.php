<?php

use App\Models\User;
use App\Notifications\DefaultNotification;
use Illuminate\Support\Facades\Notification;

it('has support directory', function () {
    $this->assertTrue(file_exists(base_path('/support')));
    $this->assertTrue(file_exists(base_path('/support/helpers.php')));
});

it('has notification helpers', function () {
    $this->assertTrue(function_exists('notification_drivers'));
    $this->assertTrue(function_exists('notification_enabled'));
    $this->assertTrue(function_exists('notify'));
});

it('can enable and disable notifications', function () {
    $this->assertTrue(config('notification.enabled'));

    config([
        'notification' => [
            'enabled' => false,
        ],
    ]);

    $this->assertFalse(config('notification.enabled'));

    config([
        'notification' => [
            'enabled' => true,
        ],
    ]);

    $this->assertTrue(config('notification.enabled'));
});

it('has database notification driver if no driver provided', function () {
    $this->assertTrue(in_array('database', notification_drivers()) && count(notification_drivers()) == 1);
});

it('can notify to user using default notification class', function () {
    Notification::fake();

    $user = User::factory()->create();

    notify($user, 'demo', 'message');

    Notification::assertSentTo(
        [$user],
        DefaultNotification::class
    );
});
